@extends('layouts.master')
@section('content')
<div class="show-profile">
    @php
    if (!$player || !$statistic) {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $steamid = $uri[2];
    @endphp
        <h2>User with Steam ID: {{ $steamid }} does not play shared game or his profile have private settings !</h2>
    @php
    } else {
        $steamid = $player->steamid;
        $country = isset($player->loccountrycode) ? strtolower($player->loccountrycode) : 'ru';
        $date = date('d.m.Y', $player->lastlogoff);
        @endphp
        <div class="show-profile-img">
            <img src="{{ $player->avatarfull }}" >
        </div>
        <div class="show-profile-link">
            <a href="{{ $player->profileurl }}" target="_blank"><img src="public/images/steamicon.png" style="width: 25px; height: 25x;">{{ $player->personaname }} </a> |
            <img src="http://cdn.steamcommunity.com/public/images/countryflags/{{ $country }}.gif" alt=""> |
            <a href="{{route('steam-user-comparison',[$steamid]) }}">Compare</a>
            {{-- <a onclick="comparing()">Compare</a> --}}
            <input onclick="change()" type="button" value="Add to comparison" id="comparison-button" style="border: none; background:none; outline: none; background-color: #337ab7;"></input>
            <a href="{{route('steam-pdf-generate',[$steamid]) }}" target="_blank">Stats to PDF</a> |
            <a href="{{route('steam-stats-graph',[$steamid]) }}" target="_blank">Stats Graph</a>
            <h5>Last online: {{ $date }}</h5><div id="hidden_form_container" style="display:none;"></div>
        </div>
        <script type="text/javascript">
            var steamid1 = "{!! $steamid !!}";
            var steamid2 = "{!! $steamid !!}";
            var steamid = "{!! $steamid !!}";
            var comparisonLength = sessionStorage.length;
            // document.cookie="steamid-comparison_" + (comparisonLength - 1) + "=" + steamid;
            // document.cookie="steamid-comparison_" + (comparisonLength ) + "=" + steamid;
            var compariosneProfile = '';
            if (sessionStorage.getItem('steamid-comparison_' + (comparisonLength - 1)) == steamid) {
                compariosneProfile = 'steamid-comparison_' + (comparisonLength - 1);
                document.getElementById("comparison-button").value = 'Remove from comparison';
            } else if (sessionStorage.getItem('steamid-comparison_' + (comparisonLength - 2)) == steamid) {
                compariosneProfile = 'steamid-comparison_' + (comparisonLength - 2);
                document.getElementById("comparison-button").value = 'Remove from comparison';
            }
            function change()
            {
                var elem = document.getElementById("comparison-button");
                if (elem.value=="Add to comparison") {
                    elem.value = "Remove from comparison";
                    var steamid = "{!! $steamid !!}";
                    if (comparisonLength == 2) {
                        sessionStorage.setItem('steamid-comparison_' + (comparisonLength - 1), steamid);
                        compariosneProfile = 'steamid-comparison_' + (comparisonLength - 1);
                        document.cookie="steamid-comparison_" + (comparisonLength - 1) + "=" + steamid;
                    } else {
                        sessionStorage.setItem('steamid-comparison_' + comparisonLength, steamid);
                        compariosneProfile = 'steamid-comparison_' + (comparisonLength);
                        document.cookie="steamid-comparison_" + comparisonLength + "=" + steamid;
                    }
                } else {
                    elem.value = "Add to comparison";
                    sessionStorage.removeItem(compariosneProfile);
                }
            }
            function comparing()
            {
                var comparingRoute = "{{ route('steam-user-comparison',['steamid'=>$steamid]) }}";
                var theForm = document.createElement('form');
                theForm.action = comparingRoute;
                theForm.method = 'get';
                document.getElementById('hidden_form_container').appendChild(theForm);
                theForm.submit();
            }
        </script>
        @php
        if ($steamid == Session::get('steam-id')) {
            @endphp
            <script type="text/javascript">
                var twoDaysSeconds = 172800000;
                var dateUpdate = Date.now();
                var steamid = {!! $steamid !!};
                var counter = localStorage.length - 1;
                var lastStat = localStorage.getItem('counter_flick_' + steamid + '_' + counter);
                var diff = 0;
                if (lastStat && counter != -1) {
                    lastStat = JSON.parse(lastStat);
                    var lastUpdate = lastStat.timestamp;
                    diff = dateUpdate - lastUpdate - twoDaysSeconds;
                } else if (!lastStat && counter != -1) {
                    for(counter; counter >= 0; counter--) {
                        var lastStat = localStorage.getItem('counter_flick_' + steamid + '_' + counter);
                        if (lastStat) {
                            lastStat = JSON.parse(lastStat);
                            var lastUpdate = lastStat.timestamp;
                            diff = dateUpdate - lastUpdate - twoDaysSeconds;
                            break;
                        }
                    }
                }
                if (lastStat && diff > 0) {
                    var counter = localStorage.length + 1;
                    var stats = {
                        'total_kills' : {!! $statistic['user_Array']['total_kills'] !!},
                        'total_deaths' : {!! $statistic['user_Array']['total_deaths'] !!},
                        'time_played' : {!! round($statistic['user_Array']['total_time_played']/3600) !!},
                        'win' : {!! round($statistic['user_Array']['total_wins'] / $statistic['user_Array']['total_rounds_played'] * 100,1) !!},
                        'headshoots' : {!! round($statistic['user_Array']['total_kills_headshot']/$statistic['user_Array']['total_kills'] * 100,2) !!},
                        'accuracy' : {!! round($statistic['user_Array']['total_shots_hit']/$statistic['user_Array']['total_shots_fired'] * 100 ,2) !!},
                        'timestamp': dateUpdate
                    };
                    var json = JSON.stringify(stats);
                    localStorage.setItem('counter_flick_' + steamid + '_' + counter, json);
                } else if (counter == -1) {
                    var counter = localStorage.length;
                    var stats = {
                        'total_kills' : {!! $statistic['user_Array']['total_kills'] !!},
                        'total_deaths' : {!! $statistic['user_Array']['total_deaths'] !!},
                        'time_played' : {!! round($statistic['user_Array']['total_time_played']/3600) !!},
                        'win' : {!! round($statistic['user_Array']['total_wins'] / $statistic['user_Array']['total_rounds_played'] * 100,1) !!},
                        'headshoots' : {!! round($statistic['user_Array']['total_kills_headshot']/$statistic['user_Array']['total_kills'] * 100,2) !!},
                        'accuracy' : {!! round($statistic['user_Array']['total_shots_hit']/$statistic['user_Array']['total_shots_fired'] * 100 ,2) !!},
                        'timestamp': dateUpdate
                    };
                    var json = JSON.stringify(stats);
                    localStorage.setItem('counter_flick_' + steamid + '_' + counter, json);
                }
            </script>
            @php
        }
        @endphp
        @include('steam.main-stats')
        @include('steam.other-statistic')
        @php
    }
@endphp
</div>
@endsection
