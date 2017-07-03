<ol class="all-results">
  @php
    foreach ($achievementsStatistic['combat_Skills'] as $key => $value) {
        if ($achievementsStatistic['array_Achievements'][$key]['achived']) {
        @endphp
        <li class="item-achievement">
            <img src="{{ $achievementsStatistic['array_Achievements'][$key]['icon'] }}"
            alt="{{ $achievementsStatistic['array_Achievements'][$key]['description'] }}">
            <h5>{{ $achievementsStatistic['array_Achievements'][$key]['displayName'] }}</h5>
            <b>{{ date('d.M.Y', $achievementsStatistic['array_Achievements'][$key]['unlocktime']) }}</b>
        </li>
        @php } else {
            $combatSkillsUnachieved[$key] = [
                'icongray' => $achievementsStatistic['array_Achievements'][$key]['icongray'],
                'description' => $achievementsStatistic['array_Achievements'][$key]['description'],
                'displayName' => $achievementsStatistic['array_Achievements'][$key]['displayName']
            ];
        }
    }
    foreach ($combatSkillsUnachieved as $key => $value) {
        @endphp
        <li class="item-achievement">
            <img src="{{ $combatSkillsUnachieved[$key]['icongray'] }}" alt="{{ $combatSkillsUnachieved[$key]['description'] }}">
            <h5>{{ $combatSkillsUnachieved[$key]['displayName'] }}</h5>
        </li>
        @php
    }
  @endphp
</ol>
