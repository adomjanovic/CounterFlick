@extends('layouts.master')
@section('content')

    @php
    if (!isset($_COOKIE['steamid-comparison_0']) || !isset($_COOKIE['steamid-comparison_1'])) {
        echo '<div class="comparison"><h2>No players for compariosn(2 players needed)</h2></div>';
    } else {
        $steamid1 = $_COOKIE['steamid-comparison_0'];
        $url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=23E38BACEF40A739B05B305A8487184C&steamids='.$steamid1;
        $json = file_get_contents($url);
        $obj = json_decode($json);
        $player = $obj->response->players[0];
        $urlUserStatForGame = 'http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=730&key=23E38BACEF40A739B05B305A8487184C&steamid='.$steamid1;
        $jsonUserStats = file_get_contents($urlUserStatForGame);
        $objUserStats = json_decode($jsonUserStats);
        $userStats = $objUserStats->playerstats->stats;

        $steamid2 = $_COOKIE['steamid-comparison_1'];
        $url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=23E38BACEF40A739B05B305A8487184C&steamids='.$steamid2;
        $json = file_get_contents($url);
        $obj = json_decode($json);
        $player2 = $obj->response->players[0];
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
        <div class="comparison"><br>
            <div class="show-profile-full">
                <img src="{{ $player->avatarmedium }}" >
                <a href="{{route('steam-user',[$player->steamid])}}"><h3>Back to profile stats</h3></a></img>
            </div>
            <h1>Comparison</h1>
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
        @php
    }
@endphp
@endsection
