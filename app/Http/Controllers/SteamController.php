<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Services\SteamHelper;
use App\Services\FPDFHelper;

class SteamController extends Controller
{
    public function index()
    {
        $player = $finding = [];
        return view('steam.index',compact('player', 'finding'));
    }

    public function findPlayer()
    {
        $player = [];
        $steamid = $_POST['steamid'];
        $finding = true;
        if ($steamid) {
            $player = SteamHelper::searchPlayer($steamid);
        }
        return view('steam.index', compact('player', 'finding'));
    }

    public function show($steamid)
    {
        $player = SteamHelper::findSteamPlayerBySteamId($steamid);
        $statistic = [];
        if ($player) {
            $statistic = SteamHelper::showSteamUserProfile($player);
        }
        return view('steam.show', compact('player', 'statistic'));
    }

    public function showMaps()
    {
        $player = SteamHelper::findSteamPlayerUri();
        $mapsStatistic = [];
        if ($player) {
            $userStats = SteamHelper::getUserStatForGame($player);
            $mapsStatistic = SteamHelper::getUserStatForGameByMap($userStats);
        }
        return view('steam.maps', compact('player', 'mapsStatistic'));
    }

    public function showAchievements()
    {
        $player = SteamHelper::findSteamPlayerUri();
        $achievementsStatistic = [];
        if ($player) {
            $userAchievements = SteamHelper::getUserAchievements($player);
            $gameAchievements = SteamHelper::getGlobalStatsAchievements();
            $achievementsStatistic = SteamHelper::getUserStatForGameAchievements($userAchievements, $gameAchievements);
        }
        return view('steam.achievements', compact('player', 'achievementsStatistic'));
    }

    public function showWeapons()
    {
        $player = SteamHelper::findSteamPlayerUri();
        $weaponStatistic = [];
        if ($player) {
            $statistic = SteamHelper::getUserStatForGame($player);
            $weaponStats = $statistic->playerstats->stats;
            $weaponStatistic = SteamHelper::getUserStatForGameWeapons($weaponStats);
        }
        return view('steam.weapons', compact('player', 'weaponStatistic'));
    }

    public function comparison($steamid)
    {
        $player1 = SteamHelper::findSteamPlayerBySteamId($steamid);
        $checkForComparison = SteamHelper::checkForComparison();
        $player2 = $comparison = [];
        if ($checkForComparison) {
            $player1 = SteamHelper::findSteamPlayerBySteamId($_COOKIE['steamid-comparison_0']);
            $player2 = SteamHelper::findSteamPlayerBySteamId($_COOKIE['steamid-comparison_1']);
        }
        if ($player1 && $player2) {
            $userStats1 = SteamHelper::getUserStatForGame($player1);
            $userStats2 = SteamHelper::getUserStatForGame($player2);
            $comparison = SteamHelper::getPlayersComparison($userStats1, $userStats2);
        }
        return view('steam.profile-comparison', compact('player1', 'player2','comparison'));
    }

    public function logout()
    {
        Session::forget('steam-id');
        return Redirect::to(Session::get('page'));
    }

    public function generatePdf($steamid)
    {
        $player = SteamHelper::findSteamPlayerBySteamId($steamid);
        $fpdfData = SteamHelper::prepareFPDFStatistic($player, $steamid);
        FPDFHelper::showPDFStatistic($fpdfData);
        exit();
    }

    public function showStatsGraph($steamid)
    {
        return view('steam.show-graph', compact('steamid'));
    }
}
