<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use PDF;

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
    public function logout()
    {
        Session::forget('steam-id');
        return Redirect::to(Session::get('page'));
    }
    public function generatePdf($steamid)
    {
        Session::put('steamid', $steamid);
        $pdf = PDF::loadView('steam.pdf');
        Session::forget('steamid');
    	return $pdf->stream('statistic.pdf');
    }
    public function showStatsGraph($steamid)
    {
        return view('steam.show-graph', compact('steamid'));
    }
}
