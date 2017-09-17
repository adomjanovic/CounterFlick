<div class="other-statistic">

    <h2>OTHER STATISTICS</h2>
    <div class="column-left">
        <ul>
            <li>Kills <b>{{ $statistic['user_Array']['total_kills'] ?? '0'}}</b></li>
            <li>Deaths<b> {{ $statistic['user_Array']['total_deaths'] ?? '0'}}</b></li>
            <li>Time played<b> {{ round($statistic['user_Array']['total_time_played']/3600) ?? '0'}}h</b></li>
            <li>Wins<b> {{ $statistic['user_Array']['total_wins'] ?? '0'}}</b></li>
            <li>Damage done<b> {{ $statistic['user_Array']['total_damage_done'] ?? '0'}}</b></li>
            <li>Money earned<b> {{ $statistic['user_Array']['total_money_earned'] ?? '0'}} $</b></li>
            <li>MVPs<b> {{ $statistic['user_Array']['total_mvps'] ?? '0'}}</b></li>
            <li>Contribution score<b> {{ $statistic['user_Array']['total_contribution_score'] ?? '0'}}</b></li>
            <li>Weapons donated<b> {{ $statistic['user_Array']['total_weapons_donated'] ?? '0'}}</b></li>
            <li>Headshot<b> {{ $statistic['user_Array']['total_kills_headshot'] ?? '0'}}</b></li>
        </ul>
    </div>
    <div class="column-centar">
        <ul>
            <li>Pistol round won<b> {{ $statistic['user_Array']['total_wins_pistolround'] ?? '0'}}</b></li>
            <li>Defused bombs<b> {{ $statistic['user_Array']['total_defused_bombs'] ?? '0'}}</b></li>
            <li>Planted bombs<b> {{ $statistic['user_Array']['total_planted_bombs'] ?? '0'}}</b></li>
            <li>Knife kills<b> {{ $statistic['user_Array']['total_kills_knife'] ?? '0'}}</b></li>
            <li>Gun rounds won<b> {{ round($statistic['user_Array']['total_gun_game_rounds_won']/$statistic['user_Array']['total_gun_game_rounds_played'],2) ?? '0'}} %</b></li>
            <li>HE Grenade kills<b> {{ $statistic['user_Array']['total_kills_hegrenade'] ?? '0'}}</b></li>
            <li>Deagle kills<b> {{ $statistic['user_Array']['total_kills_deagle'] ?? '0'}}</b></li>
            <li>AWP kills<b> {{ $statistic['user_Array']['total_kills_awp'] ?? '0'}}</b></li>
            <li>Kills with enemy weapon<b> {{ $statistic['user_Array']['total_kills_enemy_weapon'] ?? '0'}}</b></li>
            <li>Dominations<b> {{ $statistic['user_Array']['total_dominations'] ?? '0'}}</b></li>
        </ul>
    </div>
    <div class="column-right">
        <ul>
            <li>AK47 kills<b> {{ $statistic['user_Array']['total_kills_ak47'] ?? '0'}}</b></li>
            <li>M4A1 kills<b> {{ $statistic['user_Array']['total_kills_m4a1'] ?? '0'}}</b></li>
            <li>Time played<b> {{ round($statistic['user_Array']['total_time_played']/3600) ?? '0'}}h</b></li>
            <li>Molotov kills<b>{{ $statistic['user_Array']['total_kills_molotov'] ?? '0' }}</b></li>
            <li>Zeus kills<b> {{ $statistic['user_Array']['total_kills_taser'] ?? '0' }}</b></li>
            <li>Revenges<b> {{ $statistic['user_Array']['total_revenges']  ?? '0' }}</b></li>
            <li>Zoomed sniper kills<b> {{ $statistic['user_Array']['total_kills_against_zoomed_sniper'] ?? '0' }}</b></li>
            <li>Knife fight won <b> {{ $statistic['user_Array']['total_kills_knife_fight'] ?? '0' }}</b></li>
            <li>Enemy blinded kills<b> {{ $statistic['user_Array']['total_kills_enemy_blinded'] ?? '0' }}</b></li>
            <li>Broken windows<b> {{ $statistic['user_Array']['total_broken_windows'] ?? '0' }}</b></li>
        </ul>
    </div>
</div>
