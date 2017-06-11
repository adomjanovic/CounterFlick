@php
    $steamId = $_POST['steamid'];

    if (preg_match('/[\'^£$%&*()}{@#~?><>.,|=+¬-]/', $steamId)) {
        //samo ime
    }
    // provjere i trazenje korisnika ovisno lkako je unesen uer
    $string = file_get_contents("http://steamcommunity.com/profiles/76561198018175469/");
    if (strpos($string, 'steamid') !== false) {
        $seedString = "steamid";
        $sub= substr($string,strpos($string,$seedString)+10,17);
    }

    if (is_numeric($steamId)) {
        $url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=23E38BACEF40A739B05B305A8487184C&steamids='.$steamId;
    } else {
        // ako imamo samo ime -> hexerGOD
        if (!preg_match('/[\'^£$%&*()}{@#~?><>.,|=+¬-]/', $steamId)) {
            $string = file_get_contents("http://steamcommunity.com/id/".$steamId);
            if (strpos($string, 'steamid') !== false) {
                $seedString = "steamid";
                $sub= substr($string,strpos($string,$seedString)+10,17);
                if (is_numeric($sub)) {
                    $url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=23E38BACEF40A739B05B305A8487184C&steamids='.$sub;
                }
            }
        }
        if (substr($steamId, -1) == '/') {
            $steamId = substr($steamId, 0, -1);
        }
        $s = strrpos($steamId, '/');
        $sub = substr($steamId, $s+1);

        if (is_numeric($sub)) {
            $url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=23E38BACEF40A739B05B305A8487184C&steamids='.$sub;
        } else {
            $string = file_get_contents("http://steamcommunity.com/id/".$sub);
            if (strpos($string, 'steamid') !== false) {
                $seedString = "steamid";
                $sub= substr($string,strpos($string,$seedString)+10,17);
                if (is_numeric($sub)) {
                    $url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=23E38BACEF40A739B05B305A8487184C&steamids='.$sub;
                }
            }
        }
    }
    $json = file_get_contents($url);
    $obj = json_decode($json);
    $player = 0;
    if ($obj) {
        $player = $obj->response->players;
    }
    if ($player) {
        $player = $player[0];
        @endphp
        <div class="profile-found">
            <img src="{{ $player->avatarmedium }}" alt="">
            <a href="{{route('steam-user',[$player->steamid])}}"><h2>{{ $player->personaname }}</h2></a>
        </div>
        @php
    } else {
        @endphp
        <div class="alert alert-info profile-not-found">
            <p>User not found, {{ $_POST['steamid'] }} does not exist, check format of input !</p>
        </div>
        <div class="profile-not-found-examples">
            <h4>Examples of input for searching </h4>
            <li>hexerGOD</li>
            <li>76561198185315038</li>
            <li>http://steamcommunity.com/id/hexerGOD</li>
            <li>http://steamcommunity.com/profiles/76561198018175469</li>
        </div>
        @php
    }
