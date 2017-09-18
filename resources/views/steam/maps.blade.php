@extends('layouts.master')
@section('content')
    <div class="show-profile">
        <ol class="all-results">
        @php
        if (!$player || !$mapsStatistic) {
            $uri = explode('/', $_SERVER['REQUEST_URI']);
            $userInfoPosition = count($uri) - 2;
            $steamid = $uri[$userInfoPosition];
            @endphp
                <h2>User with Steam ID: {{ $steamid }} does not play shared game or his profile have private settings !</h2>
            @php
        } else {
            @endphp
            <div class="show-profile-full">
                <img src="{{ $player->avatarmedium }}" >
                <a href="{{route('steam-user',[$player->steamid])}}"><h3>Back to profile</h3></a>
                <h5>{{ $player->personaname }} | Last online: {{ date('d.m.Y',$player->lastlogoff) }}</h5>
            </div>
            @php
            foreach ($mapsStatistic['user_Array'] as $map => $value) {
                @endphp
                    <li class="item">
                        <img src="{{ asset('public/images/maps') }}/{{ $map }}.png">
                        <h4>{{ $map }}</h4>
                        <h5>Rounds win <b>{{ $value }}</b></h5>
                        Rounds played <b>{{ $mapsStatistic['total_Rounds'][$map] }}</b>
                        Win % <b>{{ round(($value/$mapsStatistic['total_Rounds'][$map]) * 100 , 2) }} %</b>
                    </li>
                @php
            }
        }
        @endphp
        </ol>
    </div>
@endsection
