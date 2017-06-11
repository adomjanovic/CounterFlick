@extends('layouts.master')
@section('content')
@include('layouts.left-sidebar')
@include('layouts.right-sidebar')
<div class="centar">
    @include('layouts.search-box')
@php
// $url = 'http://steamcommunity.com/id/hexerGOD/asdsad';
// $s = parse_url($url, PHP_URL_PATH);
// $segments = explode('/', $s);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($_POST['steamid']))) {
        @endphp
            @include('steam.search-profile')
        @php
    }
@endphp
</div>
@endsection
