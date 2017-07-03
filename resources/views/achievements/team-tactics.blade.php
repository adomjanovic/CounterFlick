<ol class="all-results">
  @php
    foreach ($achievementsStatistic['team_Tactics'] as $key => $value) {
        if ($achievementsStatistic['array_Achievements'][$key]['achived']) {
        @endphp
        <li class="item-achievement">
            <img src="{{ $achievementsStatistic['array_Achievements'][$key]['icon'] }}"
            alt="{{ $achievementsStatistic['array_Achievements'][$key]['description'] }}">
            <h5>{{ $achievementsStatistic['array_Achievements'][$key]['displayName'] }}</h5>
            <b>{{ date('d.M.Y', $achievementsStatistic['array_Achievements'][$key]['unlocktime']) }}</b>
        </li>
        @php } else {
            $teamTacticsUnachieved[$key] = [
                'icongray' => $achievementsStatistic['array_Achievements'][$key]['icongray'],
                'description' => $achievementsStatistic['array_Achievements'][$key]['description'],
                'displayName' => $achievementsStatistic['array_Achievements'][$key]['displayName']
            ];
        }
    }
    foreach ($teamTacticsUnachieved as $key => $value) {
        @endphp
        <li class="item-achievement">
            <img src="{{ $teamTacticsUnachieved[$key]['icongray'] }}" alt="{{ $teamTacticsUnachieved[$key]['description'] }}">
            <h5>{{ $teamTacticsUnachieved[$key]['displayName'] }}</h5>
        </li>
        @php
    }
  @endphp
</ol>
