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
        $urlUserStatForGame = 'http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=730&key=23E38BACEF40A739B05B305A8487184C&steamid='.$steamid;
        $jsonUser = file_get_contents($urlUserStatForGame);
        $objUser = json_decode($jsonUser);
        $weaponStats = $objUser->playerstats->stats;
        $weaponKills = [];
        $totalHits['molotov'] = $totalHits['taser'] = $totalHits['hegrenade'] = $totalHits['knife'] = $totalHits['knife_fight'] = 0;
        $totalFired['molotov'] = $totalFired['taser'] = $totalFired['hegrenade'] = $totalFired['knife_fight'] = $totalFired['knife'] = 1;
        foreach ($weaponStats as $stat) {
            if(strpos($stat->name,'total_kills_') !== false) {
                if(!($stat->name == 'total_kills_headshot' || $stat->name == 'total_kills_enemy_weapon' || $stat->name == 'total_kills_enemy_blinded' || $stat->name == 'total_kills_against_zoomed_sniper')) {
                    $weaponKills[substr($stat->name,12)] = $stat->value;
                }
            }
            if(strpos($stat->name,'total_hits_') !== false) {
                $totalHits[substr($stat->name,11)] = $stat->value;
            }
            if(strpos($stat->name,'total_shots_') !== false) {
                if(!($stat->name == 'total_shots_hit' || $stat->name == 'total_shots_fired')) {
                    $totalFired[substr($stat->name,12)] = $stat->value;
                }
            }
        }
        arsort($totalHits);
        arsort($totalFired);
        arsort($weaponKills);
    }

    foreach ($weaponKills as $weapon => $kills) {
        @endphp
        <li class="item">
            <img src="{{ asset('public/images/weapons') }}/{{ $weapon }}.png">
            <h4>{{ strtoupper($weapon) }}</h4>
            <h5>
                Kills <b>{{ $kills }}</b>
                Accuracy % <b>{{ round(($totalHits[$weapon]/$totalFired[$weapon]) * 100 , 2) }} %</b>
            </h5>
        </li>
        {{-- <li class="item">
            <img src="{{ asset('public/images/weapons') }}/m4a4.png">
            <h4>{{ strtoupper($weapon) }}</h4>
            <h5>Kills <b>{{ $kills }}</b></h5>
            <h5>Total shots fired <b>{{ $totalFired[$weapon] }}</b></h5>
            Total hits <b>{{ $totalHits[$weapon] }}</b>
            Accuracy % <b>{{ round(($totalHits[$weapon]/$totalFired[$weapon]) * 100 , 2) }} %</b>
        </li> --}}
        @php
    }
    @endphp
    </ol>
  </div>
@endsection
