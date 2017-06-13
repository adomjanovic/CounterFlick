@extends('layouts.master')
@section('content')
@include('layouts.left-sidebar')
@include('layouts.right-sidebar')
<div class="centar">
    @include('layouts.search-box')
@php
    $params = array(
        'openid.ns'         => 'http://specs.openid.net/auth/2.0',
        'openid.mode'       => 'checkid_setup',
        'openid.return_to'  => 'http://localhost/counter_flick',
        'openid.realm'      => 'http://' . $_SERVER['HTTP_HOST'],
        'openid.identity'   => 'http://specs.openid.net/auth/2.0/identifier_select',
        'openid.claimed_id' => 'http://specs.openid.net/auth/2.0/identifier_select',
    );

    $steamLoginUrl = 'https://steamcommunity.com/openid/login' . '?' . http_build_query($params);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($_POST['steamid']))) {
        @endphp

            @include('steam.search-profile')
        @php
    }
    $steamId = 0;
    if (!empty($_GET['openid_identity'])) {
        $steamidUrl = $_GET['openid_identity'];
        $steamidUrl = explode('/',$steamidUrl);
        $steamId = $steamidUrl[5];
    }
    if($steamId && is_numeric($steamId)) {
        Session::put('steam-id', $steamId);
        @endphp
            @include('steam.search-profile')
        @php } @endphp
</div>
@endsection
