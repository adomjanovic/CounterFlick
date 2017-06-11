@extends('layouts.master')
@section('content')
  <div class="show-profile">
    <ol class="all-results">
    @php
    $uri = explode('/', $_SERVER['REQUEST_URI']);
    $steamid = $uri[2];
    $url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=23E38BACEF40A739B05B305A8487184C&steamids='.$steamid;
    $json = file_get_contents($url);
    $obj = json_decode($json);
    $player = $obj->response->players;
    if (!$player) {
        @endphp
        <p>Korisnik sa Steam ID-om {{ $steamid }} ne postoji!</p>
        @php
    } else {
        $player = $player[0];
        $date = date('d.m.Y', $player->lastlogoff);
        @endphp
        <div class="show-profile-full">
            <img src="{{ $player->avatarmedium }}" >
            <a href="{{route('steam-user',[$player->steamid])}}"><h3>Back to profile stats</h3></a>
            <h5>{{ $player->personaname }} | Last online: {{ $date }}</h5>
        </div>
        @php
        $urlUserStatForGame = 'http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=730&key=23E38BACEF40A739B05B305A8487184C&steamid='.$steamid;
        $jsonUserStats = file_get_contents($urlUserStatForGame);
        $objUserStats = json_decode($jsonUserStats);
        $userStats = $objUserStats->playerstats->stats;
        $userArray = [];
        $totalRounds = [];
        foreach ($userStats as $stat) {
            if(strpos($stat->name,'total_wins_map') !== false) {
                if(strpos($stat->name,'total_wins_map_de_house') !== false) {
                    $userArray['cs_militia'] = 1;
                } else {
                    $userArray[substr($stat->name, 15)] = $stat->value;
                }
            }
            if(strpos($stat->name,'total_rounds_map') !== false) {
                $totalRounds[substr($stat->name, 17)] = $stat->value;
            }
        }
        arsort($userArray);
        arsort($totalRounds);
        foreach ($userArray as $map => $value) {
            @endphp
                <li class="item">
                    <img src="{{ asset('public/images/maps') }}/{{ $map }}.png">
                    <h4>{{ $map }}</h4>
                    <h5>Rounds win <b>{{ $value }}</b></h5>
                    Rounds played <b>{{ $totalRounds[$map] }}</b>
                    Win % <b>{{ round(($value/$totalRounds[$map]) * 100 , 2) }} %</b>
                </li>
            @php
        }
    }
    @endphp
    </ol>
  </div>
@endsection
