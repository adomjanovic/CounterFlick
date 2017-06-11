@extends('layouts.master')
@section('content')
    @php
    $steamid2 = '76561198048091588';
    $url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=23E38BACEF40A739B05B305A8487184C&steamids='.$steamid1;
    $json = file_get_contents($url);
    $obj = json_decode($json);
    $player = $obj->response->players[0];
    $url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=23E38BACEF40A739B05B305A8487184C&steamids='.$steamid2;
    $json = file_get_contents($url);
    $obj = json_decode($json);
    $player2 = $obj->response->players[0];

    $urlUserStatForGame = 'http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=730&key=23E38BACEF40A739B05B305A8487184C&steamid='.$steamid1;
    $jsonUserStats = file_get_contents($urlUserStatForGame);
    $objUserStats = json_decode($jsonUserStats);
    $userStats = $objUserStats->playerstats->stats;

    $urlUserStatForGame2 = 'http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=730&key=23E38BACEF40A739B05B305A8487184C&steamid='.$steamid2;
    $jsonUserStats2 = file_get_contents($urlUserStatForGame2);
    $objUserStats2 = json_decode($jsonUserStats2);
    $userStats2 = $objUserStats2->playerstats->stats;
    foreach ($userStats as $stat) {
        $userArray[$stat->name] = $stat->value;
    }
    foreach ($userStats2 as $stat) {
        $userArray2[$stat->name] = $stat->value;
    }
    $array1 = $array2 = [];
    $array1[0] = $userArray['total_kills'];
    $array1[1] = $userArray['total_deaths'];
    $array1[2] = round($userArray['total_time_played']/3600);
    $array1[3] = $userArray['total_wins'];
    $array1[4] = $userArray['total_damage_done'];
    $array1[5] = $userArray['total_money_earned'];
    $array1[6] = $userArray['total_mvps'];
    $array1[7] = $userArray['total_contribution_score'];
    $array1[8] = $userArray['total_weapons_donated'];
    $array1[9] = $userArray['total_kills_headshot'];
    $array1[10] = $userArray['total_wins_pistolround'];
    $array1[11] = $userArray['total_kills_hegrenade'];
    $array1[12] = $userArray['total_kills_deagle'];
    $array1[13] = $userArray['total_kills_awp'];
    $array1[14] = $userArray['total_kills_molotov'];
    $array1[15] = $userArray['total_kills_m4a1'];
    $array1[16] = $userArray['total_kills_ak47'];
    $array1[17] = $userArray['total_kills_knife'];
    $array1[18] = $userArray['total_kills_taser'];
    $array1[19] = $userArray['total_broken_windows'];
    $array1[20] = round($userArray['total_gun_game_rounds_won']/$userArray['total_gun_game_rounds_played'],2);

    $array2[0] = $userArray2['total_kills'];
    $array2[1] = $userArray2['total_deaths'];
    $array2[2] = round($userArray2['total_time_played']/3600);
    $array2[3] = $userArray2['total_wins'];
    $array2[4] = $userArray2['total_damage_done'];
    $array2[5] = $userArray2['total_money_earned'];
    $array2[6] = $userArray2['total_mvps'];
    $array2[7] = $userArray2['total_contribution_score'];
    $array2[8] = $userArray2['total_weapons_donated'];
    $array2[9] = $userArray2['total_kills_headshot'];
    $array2[10] = $userArray2['total_wins_pistolround'];
    $array2[11] = $userArray2['total_kills_hegrenade'];
    $array2[12] = $userArray2['total_kills_deagle'];
    $array2[13] = $userArray2['total_kills_awp'];
    $array2[14] = $userArray2['total_kills_molotov'];
    $array2[15] = $userArray2['total_kills_m4a1'];
    $array2[16] = $userArray2['total_kills_ak47'];
    $array2[17] = $userArray2['total_kills_knife'];
    $array2[18] = $userArray2['total_kills_taser'];
    $array2[19] = $userArray2['total_broken_windows'];
    $array2[20] = round($userArray2['total_gun_game_rounds_won']/$userArray2['total_gun_game_rounds_played'],2);

    $arrayNaslovi[0] = 'Total kills';
    $arrayNaslovi[1] = 'Total deaths';
    $arrayNaslovi[2] = 'Time played';
    $arrayNaslovi[3] = 'Wins';
    $arrayNaslovi[4] = 'Damage done';
    $arrayNaslovi[5] = 'Money earned';
    $arrayNaslovi[6] = 'MVPs';
    $arrayNaslovi[7] = 'Contribution score';
    $arrayNaslovi[8] = 'Weapons donated';
    $arrayNaslovi[9] = 'Headshots';
    $arrayNaslovi[10] = 'Pistol round won';
    $arrayNaslovi[11] = 'HE grande kills';
    $arrayNaslovi[12] = 'Deagle kills';
    $arrayNaslovi[13] = 'AWP kills';
    $arrayNaslovi[14] = 'Molotov kills';
    $arrayNaslovi[15] = 'M4A1 kills';
    $arrayNaslovi[16] = 'AK47 kills';
    $arrayNaslovi[17] = 'Knife kills';
    $arrayNaslovi[18] = 'Teaser kills';
    $arrayNaslovi[19] = 'Broken windows';
    $arrayNaslovi[20] = 'Gun rounds won';

    @endphp
    <div class="comparison">
        <h1>Player comparison</h1>
        <table class="comparison-table">
            <tr>
                <td class="profile-found">
                    <img src="{{ $player->avatarmedium }}" alt="">
                    <a href="{{route('steam-user',[$player->steamid])}}"><h2>{{ $player->personaname }}</h2></a>
                </td>
                <td class="profile-found">
                    <img src="{{ $player2->avatarmedium }}" alt="">
                    <a href="{{route('steam-user',[$player2->steamid])}}"><h2>{{ $player2->personaname }}</h2></a>
                </td>

            </tr>
            @php
                for($i = 0; $i <= 20; $i++) {
            @endphp
            <tr>
                <th>{{ $arrayNaslovi[$i] }}</th>
                @php
                    if ($array1[$i] < $array2[$i]) {
                        @endphp
                        <td class="min">{{ $array1[$i] }}</td>
                        <td class="max">{{ $array2[$i] }}</td>
                        @php
                    } else {
                        @endphp
                        <td class="max">{{ $array1[$i] }}</td>
                        <td class="min">{{ $array2[$i] }}</td>
                        @php
                    }
                    @endphp
                <td></td>
                <td></td>
            </tr>
            @php
        }
            @endphp
        </table>
    </div>

    {{-- <div class="comparison-centar">
        <h2>Player comparison</h2>
        <div class="left">
            <h1>Player one</h1>
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
        <div class="right">
            <h1>Player two</h1>
            <ul>
                <li>Kills <b>{{ $userArray2['total_kills'] }}</b></li>
                <li>Deaths<b> {{ $userArray2['total_deaths'] }}</b></li>
                <li>Time played<b> {{ round($userArray2['total_time_played']/3600) }}h</b></li>
                <li>Wins<b> {{ $userArray2['total_wins'] }}</b></li>
                <li>Damage done<b> {{ $userArray2['total_damage_done'] }}</b></li>
                <li>Money earned<b> {{ $userArray2['total_money_earned'] }} $</b></li>
                <li>MVPs<b> {{ $userArray2['total_mvps'] }}</b></li>
                <li>Contribution score<b> {{ $userArray2['total_contribution_score'] }}</b></li>
                <li>Weapons donated<b> {{ $userArray2['total_weapons_donated'] }}</b></li>
                <li>Headshot<b> {{ $userArray2['total_kills_headshot'] }}</b></li>
                <li>Pistol round won<b> {{ $userArray2['total_wins_pistolround'] }}</b></li>
                <li>Defused bombs<b> {{ $userArray2['total_defused_bombs'] }}</b></li>
                <li>Planted bombs<b> {{ $userArray2['total_planted_bombs'] }}</b></li>
                <li>Knife kills<b> {{ $userArray2['total_kills_knife'] }}</b></li>
                <li>Gun rounds won<b> {{ round($userArray2['total_gun_game_rounds_won']/$userArray2['total_gun_game_rounds_played'],2) }} %</b></li>
                <li>HE Grenade kills<b> {{ $userArray2['total_kills_hegrenade'] }}</b></li>
                <li>Deagle kills<b> {{ $userArray2['total_kills_deagle'] }}</b></li>
                <li>AWP kills<b> {{ $userArray2['total_kills_awp'] }}</b></li>
                <li>Kills with enemy weapon<b> {{ $userArray2['total_kills_enemy_weapon'] }}</b></li>
                <li>Dominations<b> {{ $userArray2['total_dominations'] }}</b></li>
                <li>AK47 kills<b> {{ $userArray2['total_kills_ak47'] }}</b></li>
                <li>M4A1 kills<b> {{ $userArray2['total_kills_m4a1'] }}</b></li>
                <li>Time played<b> {{ round($userArray2['total_time_played']/3600) }}h</b></li>
                <li>Molotov kills<b> {{ $userArray2['total_kills_molotov'] }}</b></li>
                <li>Zeus kills<b> {{ $userArray2['total_kills_taser'] }}</b></li>
                <li>Revenges<b> {{ $userArray2['total_revenges'] }}</b></li>
                <li>Zoomed sniper kills<b> {{ $userArray2['total_kills_against_zoomed_sniper'] }}</b></li>
                <li>Knife fight won <b> {{ $userArray2['total_kills_knife_fight'] }}</b></li>
                <li>Enemy blinded kills<b> {{ $userArray2['total_kills_enemy_blinded'] }}</b></li>
                <li>Broken windows<b> {{ $userArray2['total_broken_windows'] }}</b></li>
            </ul>
        </div>
    </div> --}}
@endsection
