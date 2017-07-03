<ol class="all-results">
  @php
    foreach ($achievementsStatistic['weapon_Specialist'] as $key => $value) {
        if ($achievementsStatistic['array_Achievements'][$key]['achived']) {
        @endphp
        <li class="item-achievement">
            <img src="{{ $achievementsStatistic['array_Achievements'][$key]['icon'] }}"
            alt="{{ $achievementsStatistic['array_Achievements'][$key]['description'] }}">
            <h5>{{ $achievementsStatistic['array_Achievements'][$key]['displayName'] }}</h5>
            <b>{{ date('d.M.Y', $achievementsStatistic['array_Achievements'][$key]['unlocktime']) }}</b>
        </li>
        @php } else {
            $weaponSpecialistUnachieved[$key] = [
                'icongray' => $achievementsStatistic['array_Achievements'][$key]['icongray'],
                'description' => $achievementsStatistic['array_Achievements'][$key]['description'],
                'displayName' => $achievementsStatistic['array_Achievements'][$key]['displayName']
            ];
        }
    }
    foreach ($weaponSpecialistUnachieved as $key => $value) {
        @endphp
        <li class="item-achievement">
            <img src="{{ $weaponSpecialistUnachieved[$key]['icongray'] }}" alt="{{ $weaponSpecialistUnachieved[$key]['description'] }}">
            <h5>{{ $weaponSpecialistUnachieved[$key]['displayName'] }}</h5>
        </li>
        @php
    }
  @endphp
</ol>
