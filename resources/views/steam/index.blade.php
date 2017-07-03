@extends('layouts.master')
@section('content')
@include('layouts.left-sidebar')
@include('layouts.right-sidebar')
<div class="centar">
    @include('layouts.search-box')
    @php
    if ($player) {
        @endphp
        <div class="profile-found">
            <img src="{{ $player->avatarmedium }}" alt="">
            <a href="{{route('steam-user',[$player->steamid])}}"><h2>{{ $player->personaname }}</h2></a>
        </div>
        @php
    } else if ($finding) {
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
    
    $steamId = 0;
    if (!empty($_GET['openid_identity'])) {
        $steamidUrl = $_GET['openid_identity'];
        $steamidUrl = explode('/',$steamidUrl);
        $steamId = $steamidUrl[5];
    }
    if ($steamId && is_numeric($steamId)) {
        Session::put('steam-id', $steamId);
    }
    @endphp
</div>
@endsection
