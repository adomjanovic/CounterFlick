<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Fpdf;

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
    public function comparison($steamid1 = 0, $steamid2 = 0)
    {
        return view('steam.profile-comparison', compact('steamid1', 'steamid2'));
    }
    public function logout()
    {
        Session::forget('steam-id');
        return Redirect::to(Session::get('page'));
    }
    public function generatePdf($steamid)
    {
        $steamID = $steamid;
        $url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=23E38BACEF40A739B05B305A8487184C&steamids='.$steamID;
        $json = file_get_contents($url);
        $obj = json_decode($json);
        $player = $obj->response->players;
        $player = $player[0];
        $country = isset($player->loccountrycode) ? strtolower($player->loccountrycode) : 'ru';
        $date = date('d.m.Y', $player->lastlogoff);
        $img = $player->avatarfull;
        $name =  $player->personaname;
        $urlUserStatForGame = 'http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=730&key=23E38BACEF40A739B05B305A8487184C&steamid='.$steamID;
        $jsonUserStats = file_get_contents($urlUserStatForGame);
        $objUserStats = json_decode($jsonUserStats);
        $userStats = $objUserStats->playerstats->stats;
        foreach ($userStats as $stat) {
            $userArray[$stat->name] = $stat->value;
        }
        $pdf = new Fpdf();
        $pdf::Ln();
        $pdf::AddPage();
        $pdf::SetFont('Times','B',22);
        $pdf::Cell(0,10, $name, 0,"","C");
        $pdf::Image($img,150,20,50);
        $pdf::Ln();
        $pdf::SetFont('Times','',12);
        $i = 0;
        foreach ($userArray as $stat => $value) {
            $pdf::cell(100,10,$stat,1,0,"L");
            $pdf::cell(30,10,$value,1,0,"L");
            $pdf::Ln();
        }
        $pdf::Output();
        exit;
    }
    public function showStatsGraph($steamid)
    {
        return view('steam.show-graph', compact('steamid'));
    }
}
