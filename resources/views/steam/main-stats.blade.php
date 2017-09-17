<div class="show-profile-stats">
    <h3>TOTAL KILLS: </h3><p>{{ $statistic['user_Array']['total_kills'] }} </p>
    <h3>TOTAL DEATHS:</h3> <p>{{ $statistic['user_Array']['total_deaths'] }} </p>
    <h3>KILL/DEATH RATIO:</h3> <p>{{ round($statistic['user_Array']['total_kills']/$statistic['user_Array']['total_deaths'],2) }} </p>
    <h3>TIME PLAYED:</h3> <p>{{ round($statistic['user_Array']['total_time_played']/3600) }}h </p>
    <h3>WIN: </h3><p>{{ round($statistic['user_Array']['total_wins'] / $statistic['user_Array']['total_rounds_played'] * 100,1) }} % </p>
    <h3>MVPs: </h3><p>{{ $statistic['user_Array']['total_mvps'] }} </p>
    <h3>HEADSHOOTS%:</h3> <p>{{ round($statistic['user_Array']['total_kills_headshot']/$statistic['user_Array']['total_kills'] * 100,2) }} %</p>
    <h3>ACCURACY%: </h3><p>{{ round($statistic['user_Array']['total_shots_hit']/$statistic['user_Array']['total_shots_fired'] * 100 ,2) }} %</p>
</div>

<div class="main-statistics-container">
    <div class="main-statistics left">
        <a href="{{route('steam-user-achievements',[$steamid])}}">
            <h2>Achievements</h2>
            <img src="{{ asset('public/images/achievements') }}.png" alt="">
        </a>
    </div>
    <div class="main-statistics right">
        <a href="{{route('steam-user-maps',[$steamid])}}">
            <h2>Maps</h2>
            <img src="{{ asset('public/images/csgomaps.png') }}" alt="">
        </a>
    </div>
    <div class="main-statistics center">
        <a href="{{route('steam-user-weapons',[$steamid])}}">
            <h2>Weapons</h2>
            <img src="{{ asset('public/images/weapon.png') }}" alt="">
        </a>
    </div>
</div>
