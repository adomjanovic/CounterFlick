@extends('layouts.master')
@section('content')
  <div class="show-profile">
    @php
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
            <div class="show-profile-img">
                <img src="{{ $player->avatarfull }}" >
            </div>
            <div class="show-profile-link">
                <a href="{{ $player->profileurl }}"><img src="public/images/steamicon.png" style="width: 25px; height: 25x;">{{ $player->personaname }} </a> |
                <img src="http://cdn.steamcommunity.com/public/images/countryflags/{{ $country }}.gif" alt=""> |
                <a href="{{route('steam-user-comparison',[$steamid]) }}">Compare</a> |
                <a href="{{route('steam-pdf-generate',[$steamid]) }}" target="_blank">Stats to PDF</a>
                <h5>Last online: {{ $date }}</h5>
            </div>
            @php
            $urlGameAchievements = 'http://api.steampowered.com/ISteamUserStats/GetSchemaForGame/v2/?key=23E38BACEF40A739B05B305A8487184C&appid=730';
            $urlUserAchievements = 'http://api.steampowered.com/ISteamUserStats/GetPlayerAchievements/v0001/?appid=730&key=23E38BACEF40A739B05B305A8487184C&steamid='.$steamid;
            $urlUserStatForGame = 'http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=730&key=23E38BACEF40A739B05B305A8487184C&steamid='.$steamid;
            $jsonUser = file_get_contents($urlUserAchievements);
            $objUser = json_decode($jsonUser);
            $jsonUserStats = file_get_contents($urlUserStatForGame);
            $objUserStats = json_decode($jsonUserStats);
            $json = file_get_contents($urlGameAchievements);
            $obj = json_decode($json);
            $userAchievements = $objUser->playerstats->achievements;
            $userStats = $objUserStats->playerstats->stats;
            $gameAchievements = $obj->game->availableGameStats->achievements;
            $i = 0;
            $achived = 0;
            $totalKills['value'] = 0;
            $totalKills['name'] = '';
            $totalWins['value'] = 0;
            $totalWins['name'] = '';
            foreach ($userStats as $stat) {
                if(strpos($stat->name,'total_kills_') !== false && $stat->name != 'total_kills_headshot' && $totalKills['value'] <= $stat->value) {
                    $totalKills['name'] = $stat->name;
                    $totalKills['value'] = $stat->value;
                }
                if(strpos($stat->name,'total_wins_map') !== false && $totalWins['value'] <= $stat->value) {
                    $totalWins['name'] = $stat->name;
                    $totalWins['value'] = $stat->value;
                }
                $userArray[$stat->name] = $stat->value;
            }
            $latestAchived = [];
            $totalKills['name'] = substr($totalKills['name'], 12);
            $totalWins['name'] = substr($totalWins['name'], 15);
            foreach ($gameAchievements as $achievements) {
                if ($userAchievements[$i]->apiname == $achievements->name ) {
                    if ($userAchievements[$i]->achieved == 1) {
                        $latestAchived[$i] = $achievements;
                        $achived++;
                    }
                }
                $i++;
            }
    }
    @endphp
    <div class="show-profile-stats">
        <h3>TOTAL KILLS: </h3><p>{{ $userArray['total_kills'] }} </p>
        <h3>TOTAL DEATHS:</h3> <p>{{ $userArray['total_deaths'] }} </p>
        <h3>KILL/DEATH RATIO:</h3> <p>{{ round($userArray['total_kills']/$userArray['total_deaths'],2) }} </p>
        <h3>TIME PLAYED:</h3> <p>{{ round($userArray['total_time_played']/3600) }}h </p>
        <h3>WIN: </h3><p>{{ round($userArray['total_wins'] / $userArray['total_rounds_played'] * 100,1) }} % </p>
        <h3>MVPs: </h3><p>{{ $userArray['total_mvps'] }} </p>
        <h3>HEADSHOOTS%:</h3> <p>{{ round($userArray['total_kills_headshot']/$userArray['total_kills'] * 100,2) }} %</p>
        <h3>ACCURACY%: </h3><p>{{ round($userArray['total_shots_hit']/$userArray['total_shots_fired'] * 100 ,2) }} %</p>
    </div>

    <div class="column-left">
        <a href="{{route('steam-user-achievements',[$steamid])}}">
            <h2>ACHIEVEMENTS</h2>
            <img src="{{ asset('public/images/achievements') }}.png" alt="">
        </a>
    </div>
    <div class="column-right">
        <a href="{{route('steam-user-maps',[$steamid])}}">
            <h2>MAP STATISTIC</h2>
            <img src="{{ asset('public/images/csgomaps.png') }}" alt="">
        </a>
    </div>
    <div class="column-centar">
        <a href="{{route('steam-user-weapons',[$steamid])}}">
            <h2>WEAPON STATISTIC</h2>
            <img src="{{ asset('public/images/weapon.png') }}" alt="">
        </a>
    </div>
    <div class="other-statistic">
        <h2>OTHER STATISTICS</h2>
        <div class="column-left">
            <ul>
                <li>Kills <b>{{ $userArray['total_kills'] }}</b></li>
                <li>Deaths<b> {{ $userArray['total_deaths'] }}</b></li>
                <li>Time played<b> {{ round($userArray['total_time_played']/3600) }}h</b></li>
                <li>Wins<b> {{ $userArray['total_wins'] }}</b></li>
                <li>Damage done<b> {{ $userArray['total_damage_done'] }}</b></li>
                <li>Money earned<b> {{ $userArray['total_money_earned'] }} $</b></li>
                <li>MVPs<b> {{ $userArray['total_mvps'] }}</b></li>
                <li>Contribution score<b> {{ $userArray['total_contribution_score'] }}</b></li>
                <li>Weapons donated<b> {{ $userArray['total_weapons_donated'] }}</b></li>
                <li>Headshot<b> {{ $userArray['total_kills_headshot'] }}</b></li>
            </ul>
        </div>
        <div class="column-centar">
            <ul>
                <li>Pistol round won<b> {{ $userArray['total_wins_pistolround'] }}</b></li>
                <li>Defused bombs<b> {{ $userArray['total_defused_bombs'] }}</b></li>
                <li>Planted bombs<b> {{ $userArray['total_planted_bombs'] }}</b></li>
                <li>Knife kills<b> {{ $userArray['total_kills_knife'] }}</b></li>
                <li>Gun rounds won<b> {{ round($userArray['total_gun_game_rounds_won']/$userArray['total_gun_game_rounds_played'],2) }} %</b></li>
                <li>HE Grenade kills<b> {{ $userArray['total_kills_hegrenade'] }}</b></li>
                <li>Deagle kills<b> {{ $userArray['total_kills_deagle'] }}</b></li>
                <li>AWP kills<b> {{ $userArray['total_kills_awp'] }}</b></li>
                <li>Kills with enemy weapon<b> {{ $userArray['total_kills_enemy_weapon'] }}</b></li>
                <li>Dominations<b> {{ $userArray['total_dominations'] }}</b></li>
            </ul>
        </div>
        <div class="column-right">
            <ul>
                <li>AK47 kills<b> {{ $userArray['total_kills_ak47'] }}</b></li>
                <li>M4A1 kills<b> {{ $userArray['total_kills_m4a1'] }}</b></li>
                <li>Time played<b> {{ round($userArray['total_time_played']/3600) }}h</b></li>
                <li>Molotov kills<b> {{ $userArray['total_kills_molotov'] }}</b></li>
                <li>Zeus kills<b> {{ $userArray['total_kills_taser'] }}</b></li>
                <li>Revenges<b> {{ $userArray['total_revenges'] }}</b></li>
                <li>Zoomed sniper kills<b> {{ $userArray['total_kills_against_zoomed_sniper'] }}</b></li>
                <li>Knife fight won <b> {{ $userArray['total_kills_knife_fight'] }}</b></li>
                <li>Enemy blinded kills<b> {{ $userArray['total_kills_enemy_blinded'] }}</b></li>
                <li>Broken windows<b> {{ $userArray['total_broken_windows'] }}</b></li>
            </ul>
        </div>
    </div>
  </div>
@endsection
