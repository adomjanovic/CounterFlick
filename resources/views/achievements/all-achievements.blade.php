<ol class="all-results">
@php
    foreach ($achievementsStatistic['game_Achievements'] as $achievements) {
        if ($achievementsStatistic['user_Achievements'][$i]->apiname == $achievements->name ){
            if ($achievementsStatistic['user_Achievements'][$i]->achieved == 1) {
                $achived++;
                @endphp
                <li class="item-achievement">
                    <img src="{{ $achievements->icon }}" alt=""><h5>{{ $achievements->displayName }}</h5>
                    <b>{{ date('d.M.Y', $achievementsStatistic['user_Achievements'][$i]->unlocktime) }}</b>
                </li>
                @php
            } else {
              $noAchived[$j] = $achievements;
              $j++;
            }
        }
        $i++;
    }
    foreach ($noAchived as $achievements) {
    @endphp
        <li class="item-achievement">
            <img src="{{ $achievements->icongray }}" alt=""><h5>{{ $achievements->displayName }}</h5>
        </li>
    @php
    }
@endphp
</ol>
