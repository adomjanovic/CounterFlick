@extends('layouts.master')
@section('content')
    @php if (!$comparison) {
        echo '<div class="comparison"><h2>No players for compariosn(2 players needed)</h2></div>';
    } else { @endphp
    <div class="comparison"><br>
        <div class="show-profile-full">
            <img src="{{ $player1->avatarmedium }}" >
            <a href="{{route('steam-user',[$player1->steamid])}}"><h3>Back to profile stats</h3></a>
        </div>
        <h1>Player's comparison</h1>
        <table class="comparison-table">
            <tr>
                <th class="images">
                    <img src="{{ $player1->avatarmedium }}" alt="">
                    <a href="{{route('steam-user',[$player1->steamid])}}"><h2>{{ $player1->personaname }}</h2></a>
                </th>
                <th class="images">
                    <img src="{{ $player2->avatarmedium }}" alt="">
                    <a href="{{route('steam-user',[$player2->steamid])}}"><h2>{{ $player2->personaname }}</h2></a>
                </th>
            </tr>
            @php for($i = 0; $i <= 20; $i++) { @endphp
            <tr>
                <th>{{ $comparison['stat_names'][$i] }}</th>
                @php if ($comparison['user_Stats_One'][$i] < $comparison['user_Stats_Two'][$i]) { @endphp
                        <td class="min">{{ $comparison['user_Stats_One'][$i] }}</td>
                        <td class="max">{{ $comparison['user_Stats_Two'][$i] }}</td>
                        @php } else { @endphp
                        <td class="max">{{ $comparison['user_Stats_One'][$i] }}</td>
                        <td class="min">{{ $comparison['user_Stats_Two'][$i] }}</td>
                    @php } @endphp
            </tr>
        @php } @endphp
        </table>
    </div>
    @php } @endphp
@endsection
