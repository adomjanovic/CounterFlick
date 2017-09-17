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

<div class="column-left main-statistics">
    <a href="{{route('steam-user-achievements',[$steamid])}}">
        <div class="image-text">
            <h2>Achievements stats</h2>
        </div>
        <img src="{{ asset('public/images/achievements') }}.png" alt="">
    </a>
</div>
<div class="column-right main-statistics">
    <a href="{{route('steam-user-maps',[$steamid])}}">
        <div class="image-text">
            <h2>Map stats</h2>
        </div>
        <img src="{{ asset('public/images/csgomaps.png') }}" alt="">
    </a>
</div>
<div class="column-centar main-statistics">
    <a href="{{route('steam-user-weapons',[$steamid])}}">
        <div class="image-text">
            <h2>Weapon stats</h2>
        </div>
        <img src="{{ asset('public/images/weapon.png') }}" alt="">
    </a>
</div>
