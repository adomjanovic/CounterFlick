<ol class="all-results">
  @php
    foreach ($achievementsStatistic['arms_Race_Demolition'] as $key => $value) {
        if ($achievementsStatistic['array_Achievements'][$key]['achived']) {
        @endphp
        <li class="item-achievement">
            <img src="{{ $achievementsStatistic['array_Achievements'][$key]['icon'] }}"
            alt="{{ $achievementsStatistic['array_Achievements'][$key]['description'] }}">
            <h5>{{ $achievementsStatistic['array_Achievements'][$key]['displayName'] }}</h5>
            <b>{{ date('d.M.Y', $achievementsStatistic['array_Achievements'][$key]['unlocktime']) }}</b>
        </li>
        @php } else {
            $armsRaceDemolitionUnachieved[$key] = [
                'icongray' => $achievementsStatistic['array_Achievements'][$key]['icongray'],
                'description' => $achievementsStatistic['array_Achievements'][$key]['description'],
                'displayName' => $achievementsStatistic['array_Achievements'][$key]['displayName']
            ];
        }
    }
    foreach ($armsRaceDemolitionUnachieved as $key => $value) {
        @endphp
        <li class="item-achievement">
            <img src="{{ $armsRaceDemolitionUnachieved[$key]['icongray'] }}" alt="{{ $armsRaceDemolitionUnachieved[$key]['description'] }}">
            <h5>{{ $armsRaceDemolitionUnachieved[$key]['displayName'] }}</h5>
        </li>
        @php
    }
    @endphp
</ol>
