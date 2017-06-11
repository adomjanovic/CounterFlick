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
        $country = isset($player->loccountrycode) ? strtolower($player->loccountrycode) : '';
        $date = date('d.m.Y', $player->lastlogoff);
        @endphp
        <div class="show-profile-full">
            <img src="{{ $player->avatarmedium }}" >
            <a href="{{route('steam-user',[$player->steamid])}}"><h3>Back to profile stats</h3></a>
            <h5>{{ $player->personaname }} | Last online: {{ $date }}</h5>
        </div>
        @php
        $urlGameAchievements = 'http://api.steampowered.com/ISteamUserStats/GetSchemaForGame/v2/?key=23E38BACEF40A739B05B305A8487184C&appid=730';
        $urlUserAchievements = 'http://api.steampowered.com/ISteamUserStats/GetPlayerAchievements/v0001/?appid=730&key=23E38BACEF40A739B05B305A8487184C&steamid='.$steamid;
        $jsonUser = file_get_contents($urlUserAchievements);
        $objUser = json_decode($jsonUser);
        $json = file_get_contents($urlGameAchievements);
        $obj = json_decode($json);
        $userAchievements = $objUser->playerstats->achievements;
        $gameAchievements = $obj->game->availableGameStats->achievements;
        $i = $j = 0;
        $achived = 0;
        $noAchived = [];
        // foreach ($gameAchievements as $achievements) {
        //     if ($userAchievements[$i]->apiname == $achievements->name ){
        //         if ($userAchievements[$i]->achieved == 1) {
        //             $achived++;
        //         } else {
        //
        //         }
        //     }
        //     $i++;
        // }
        // arsort($userAchievements);
        //
        // $userAchievementsNovi = array_values($userAchievements);
        // dd($userAchievementsNovi);
        foreach ($gameAchievements as $achievements) {
            if ($userAchievements[$i]->apiname == $achievements->name ){
                if ($userAchievements[$i]->achieved == 1) {
                    $achived++;
                    @endphp
                    <li class="item-achievement">
                        <img src="{{ $achievements->icon }}" alt=""><h5>{{ $achievements->displayName }}</h5>
                        <b>{{ date('d.M.Y', $userAchievements[$i]->unlocktime) }}</b>
                    </li>
                    @php
                } else {
                    $noAchived[$j] = $achievements;
                    $j++;
                }
            }
            $i++;
        }
    }

    foreach ($noAchived as $achievements) {
        @endphp
        <li class="item-achievement">
            <img src="{{ $achievements->icongray }}" alt=""><h5>{{ $achievements->displayName }}</h5>
        </li>
        @php
    }
    @endphp
    </ol>
  </div>
@endsection
