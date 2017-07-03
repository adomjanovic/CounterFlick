<ol class="all-results">
  @php
    foreach ($achievementsStatistic['global_Expertise'] as $key => $value) {
        if ($achievementsStatistic['array_Achievements'][$key]['achived']) {
        @endphp
        <li class="item-achievement">
            <img src="{{ $achievementsStatistic['array_Achievements'][$key]['icon'] }}"
            alt="{{ $achievementsStatistic['array_Achievements'][$key]['description'] }}">
            <h5>{{ $achievementsStatistic['array_Achievements'][$key]['displayName'] }}</h5>
            <b>{{ date('d.M.Y', $achievementsStatistic['array_Achievements'][$key]['unlocktime']) }}</b>
        </li>
        @php } else {
            $globalExpertiseUnachieved[$key] = [
                'icongray' => $achievementsStatistic['array_Achievements'][$key]['icongray'],
                'description' => $achievementsStatistic['array_Achievements'][$key]['description'],
                'displayName' => $achievementsStatistic['array_Achievements'][$key]['displayName']
            ];
        }
    }
    foreach ($globalExpertiseUnachieved as $key => $value) {
        @endphp
        <li class="item-achievement">
            <img src="{{ $globalExpertiseUnachieved[$key]['icongray'] }}" alt="{{ $globalExpertiseUnachieved[$key]['description'] }}">
            <h5>{{ $globalExpertiseUnachieved[$key]['displayName'] }}</h5>
        </li>
        @php
    }
  @endphp
</ol>
