<header id="header" class="clearfix">
    <a href="{{ route('main-page') }}">
        <img src="{{ asset('public/images/csgo-header.jpg') }}" class="header-logo">
    </a>
    <h1 class="blog-title">COUNTER FLICK</h1>
    <p class="header-info">find player statistic from Counter Strike: Global Offensive</p>
    @php
    $page = 'http://localhost' . $_SERVER['REQUEST_URI'];
    $steamidSession = Session::get('steam-id');
        if ($steamidSession) {
            Session::put('page', $page);
            @endphp
                <a href="{{ route('steam-logout') }}">
                    <p>Sing out</p>
                </a>
            @php
        } else {
            $params = array(
                'openid.ns'         => 'http://specs.openid.net/auth/2.0',
                'openid.mode'       => 'checkid_setup',
                'openid.return_to'  => 'http://localhost/counter_flick',
                'openid.realm'      => 'http://' . $_SERVER['HTTP_HOST'],
                'openid.identity'   => 'http://specs.openid.net/auth/2.0/identifier_select',
                'openid.claimed_id' => 'http://specs.openid.net/auth/2.0/identifier_select',
            );
            $steamLoginUrl = 'https://steamcommunity.com/openid/login' . '?' . http_build_query($params);
        @endphp
            <a href="{{ $steamLoginUrl }}">
                <img src="{{ asset('public/images/steam.png') }}" class="steam-logon">
            </a>
        @php }
    @endphp
</header>
