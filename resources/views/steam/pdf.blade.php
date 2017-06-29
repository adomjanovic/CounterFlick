<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="{{URL::asset('/public/css/style.css')}}" rel="stylesheet">
    </head>
    @php
        $steamid = Session::get('steam-id');
        $steamID = Session::get('steamid');
        // if (!$steamid) {
        //     echo '<h3>There is no selected user for stats, find the player and select on their profile <i>Stats to PDF</i>.<br><br>
        //     (You need to be sing in through Steam)</h3>';
        //     return Redirect::to('steam.index');
        // }
        // if (!$steamID) {
        //     $steamID = $steamid;
        // }
    @endphp
    <body>
        <div class="show-profile">
          @php
              $url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=23E38BACEF40A739B05B305A8487184C&steamids='.$steamID;
              $json = file_get_contents($url);
              $obj = json_decode($json);
              $player = $obj->response->players;
              $player = $player[0];
              $country = isset($player->loccountrycode) ? strtolower($player->loccountrycode) : 'ru';
              $date = date('d.m.Y', $player->lastlogoff);
              $urlUserAchievements = 'http://api.steampowered.com/ISteamUserStats/GetPlayerAchievements/v0001/?appid=730&key=23E38BACEF40A739B05B305A8487184C&steamid='.$steamID;
              $urlUserStatForGame = 'http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=730&key=23E38BACEF40A739B05B305A8487184C&steamid='.$steamID;
              $jsonUser = file_get_contents($urlUserAchievements);
              $objUser = json_decode($jsonUser);
              $jsonUserStats = file_get_contents($urlUserStatForGame);
              $objUserStats = json_decode($jsonUserStats);
              $userAchievements = $objUser->playerstats->achievements;
              $userStats = $objUserStats->playerstats->stats;
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
              $totalKills['name'] = substr($totalKills['name'], 12);
              $totalWins['name'] = substr($totalWins['name'], 15);
          @endphp
          <div class="container">
              <div class="left-sidebar">
                  <div class="show-profile-stats-pdf">
                      <h4>TOTAL KILLS: </h4><p>{{ $userArray['total_kills'] }} </p>
                      <h4>TOTAL DEATHS:</h4> <p>{{ $userArray['total_deaths'] }} </p>
                      <h4>KILL/DEATH RATIO:</h4> <p>{{ round($userArray['total_kills']/$userArray['total_deaths'],2) }} </p>
                      <h4>TIME PLAYED:</h4> <p>{{ round($userArray['total_time_played']/3600) }}h </p>
                      <h4>WIN: </h4><p>{{ round($userArray['total_wins'] / $userArray['total_rounds_played'] * 100,1) }} % </p>
                      <h4>MVPs: </h4><p>{{ $userArray['total_mvps'] }} </p>
                      <h4>HEADSHOOTS%</h4> <p>{{ round($userArray['total_kills_headshot']/$userArray['total_kills'] * 100,2) }} %</p>
                      <h4>ACCURACY%: </h4><p>{{ round($userArray['total_shots_hit']/$userArray['total_shots_fired'] * 100 ,2) }} %</p>
                  </div>
              </div>
              <div class="right-sidebar">
                  <h3>Favorite weapon:</h3><img src="{{ asset('public/images/weapons') }}/{{ $totalKills['name'] }}.png">
                  <h5>{{ strtoupper($totalKills['name'] ) }}</h5>
                  <h3>Favorite map:</h3><img src="{{ asset('public/images/maps') }}/{{ $totalWins['name']  }}.png">
                  <h5>{{ strtoupper($totalWins['name'] ) }}</h5>
              </div>
                <div class="show-profile-img-pdf">
                <img src="{{ $player->avatarfull }}" >
                    <div class="show-profile-link">
                        <a href="{{ $player->profileurl }}"><img src="public/images/steamicon.png" style="width: 25px; height: 25x;">{{ $player->personaname }} </a> |
                        <img src="http://cdn.steamcommunity.com/public/images/countryflags/{{ $country }}.gif" alt=""> |
                        <h5>Last online: {{ $date }}</h5>
                    </div>
                </div>
            </div>
    </body>
</html>
