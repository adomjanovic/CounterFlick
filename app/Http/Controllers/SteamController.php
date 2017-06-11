<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SteamController extends Controller
{
    public function index()
    {
        return view('steam.index');
    }
    public function show($steamid)
    {
        return view('steam.show', compact('steamid'));
    }
    public function edit($steamid)
    {
        return view('steam.show', compact('steamid'));
    }
    public function showMaps()
    {
        return view('steam.maps', compact('steamid'));
    }
    public function showAchievements()
    {
        return view('steam.achievements', compact('steamid'));
    }
    public function showWeapons()
    {
        return view('steam.weapons', compact('steamid'));
    }
    public function comparison($steamid1)
    {
        return view('steam.profile-comparison', compact('steamid1'));
    }
}
