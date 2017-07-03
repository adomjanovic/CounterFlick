@extends('layouts.master')
@section('content')
<div class="show-profile">
    <ol class="all-results">
    @php
    if (!$player) {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $steamid = $uri[2];
        @endphp
            <p>Korisnik sa Steam ID-om {{ $steamid }} ne postoji!</p>
        @php
    } else {
        @endphp
        <div class="show-profile-full">
            <img src="{{ $player->avatarmedium }}" >
            <a href="{{route('steam-user',[$player->steamid])}}"><h3>Back to profile stats</h3></a>
            <h5>{{ $player->personaname }} | Last online: {{ date('d.m.Y',$player->lastlogoff) }}</h5>
        </div>
        @php
        foreach ($weaponStatistic['weapon_kills'] as $weapon => $kills) {
            @endphp
            <li class="item">
                <img src="{{ asset('public/images/weapons') }}/{{ $weapon }}.png">
                <h4>{{ strtoupper($weapon) }}</h4>
                <h5>
                    Kills <b>{{ $kills }}</b>
                    Accuracy % <b>{{ round(($weaponStatistic['total_hits'][$weapon]/$weaponStatistic['total_fired'][$weapon]) * 100 , 2) }} %</b>
                </h5>
            </li>
            @php
        }
    }
        @endphp
    </ol>
  </div>
@endsection
