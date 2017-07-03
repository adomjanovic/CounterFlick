<?php

namespace App\Services;

class SteamHelper
{
<<<<<<< HEAD
    const API_KEY = '23E38BACEF40A739B05B305A8487184C';
=======
    const API_KEY = 'PUT_YOUR_API_KEY_FROM_STEAM';
>>>>>>> 8c7faa0bc646cee1462a4a554cae948529eebc27

    public static function findSteamPlayerUri()
    {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $steamid = $uri[2];
        $url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='.self::API_KEY.'&steamids='.$steamid;
        $json = file_get_contents($url);
        $obj = json_decode($json);
        $player = $obj->response->players;
        if (!$player) {
            return [];
        } else {
            return $player[0];
        }
    }

    public static function findSteamPlayerBySteamId($steamid)
    {
        $url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='.self::API_KEY.'&steamids='.$steamid;
        $json = file_get_contents($url);
        $obj = json_decode($json);
        $player = $obj->response->players;
        if (!$player) {
            return [];
        } else {
            return $player[0];
        }
    }

    public static function getUserSteamLogged()
    {
        return Session::get('steam-id');
    }

    public static function getUserStatForGame($player)
    {
        $steamid = $player->steamid;
        $urlUserStatForGame = 'http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=730&key='.self::API_KEY.'&steamid='.$steamid;
        if (@file_get_contents($urlUserStatForGame) === false) {
            return [];
        } else {
            $jsonUserStats = file_get_contents($urlUserStatForGame);
            $objUserStats = json_decode($jsonUserStats);
            return $objUserStats;
        }
    }

    public static function getUserAchievements($player)
    {
        $steamid = $player->steamid;
        $urlUserAchievements = 'http://api.steampowered.com/ISteamUserStats/GetPlayerAchievements/v0001/?appid=730&key='.self::API_KEY.'&steamid='.$steamid;
        $jsonUser = file_get_contents($urlUserAchievements);
        $objUser = json_decode($jsonUser);
        $userAchievements = $objUser->playerstats->achievements;
        return $userAchievements;
    }

    public static function getGlobalStatsAchievements()
    {
        $urlGameAchievements = 'http://api.steampowered.com/ISteamUserStats/GetSchemaForGame/v2/?key='.self::API_KEY.'&appid=730';
        $json = file_get_contents($urlGameAchievements);
        $obj = json_decode($json);
        $gameAchievements = $obj->game->availableGameStats->achievements;
        return $gameAchievements;
    }

    public static function getUserStatForGameByMap($userStats)
    {
        $mapData = $userArray = $totalRounds = [];
        $userStats = $userStats->playerstats->stats;
        foreach ($userStats as $stat) {
            if(strpos($stat->name,'total_wins_map') !== false) {
                if(strpos($stat->name,'total_wins_map_de_house') !== false) {
                    $userArray['cs_militia'] = 1;
                } else {
                    $userArray[substr($stat->name, 15)] = $stat->value;
                }
            }
            if(strpos($stat->name,'total_rounds_map') !== false) {
                $totalRounds[substr($stat->name, 17)] = $stat->value;
            }
        }
        arsort($userArray);
        arsort($totalRounds);
        $mapData = [
            'user_Array' => $userArray,
            'total_Rounds' => $totalRounds
        ];
        return $mapData;
    }

    public static function getUserStatForGameWeapons($weaponStats)
    {
        $weaponStatistic = [];
        $totalHits['molotov'] = $totalHits['taser'] = $totalHits['hegrenade'] = $totalHits['knife'] = $totalHits['knife_fight'] = 0;
        $totalFired['molotov'] = $totalFired['taser'] = $totalFired['hegrenade'] = $totalFired['knife_fight'] = $totalFired['knife'] = 1;
        foreach ($weaponStats as $stat) {
            if(strpos($stat->name,'total_kills_') !== false) {
                if(!($stat->name == 'total_kills_headshot' || $stat->name == 'total_kills_enemy_weapon' ||
                $stat->name == 'total_kills_enemy_blinded' || $stat->name == 'total_kills_against_zoomed_sniper')) {
                    $weaponKills[substr($stat->name,12)] = $stat->value;
                }
            }
            if(strpos($stat->name,'total_hits_') !== false) {
                $totalHits[substr($stat->name,11)] = $stat->value;
            }
            if(strpos($stat->name,'total_shots_') !== false) {
                if(!($stat->name == 'total_shots_hit' || $stat->name == 'total_shots_fired')) {
                    $totalFired[substr($stat->name,12)] = $stat->value;
                }
            }
        }
        arsort($totalHits);
        arsort($totalFired);
        arsort($weaponKills);
        $weaponStatistic = [
            'total_hits' => $totalHits,
            'total_fired' => $totalFired,
            'weapon_kills' => $weaponKills,
        ];
        return $weaponStatistic;
    }

    public static function getUserStatForGameAchievements($userAchievements, $gameAchievements)
    {
        $achievementsData = [];
        $teamTactics = [
            'MEDALIST' => 'Awardist',
            'WIN_ROUNDS_LOW' => 'Newb World Order',
            'WIN_BOMB_PLANT' => 'Someone Set Up Us The Bomb',
            'WIN_ROUNDS_MED' => 'Pro-moted',
            'WIN_BOMB_DEFUSE' => 'Rite of First Defusal',
            'WIN_ROUNDS_HIGH' => 'Leet-er of Men',
            'BOMB_DEFUSE_CLOSE_CALL' => 'Second to None',
            'FAST_ROUND_WIN' => 'Blitzkrieg',
            'KILL_BOMB_DEFUSER' => 'Counter-Counter-Terrorist',
            'LOSSLESS_EXTERMINATION' => 'Mercy Rule',
            'BOMB_PLANT_IN_25_SECONDS' => 'Short Fuse',
            'FLAWLESS_VICTORY' => 'Clean Sweep',
            'KILL_BOMB_PICKUP' => 'Participation Award',
            'DONATE_WEAPONS' => 'Killanthropist',
            'BOMB_MULTIKILL' => 'Clusterstruck',
            'BLOODLESS_VICTORY' => 'Cold War',
            'GOOSE_CHASE' => 'Wild Gooseman Chase',
            'EARN_MONEY_LOW' => 'War Bonds',
            'WIN_BOMB_PLANT_AFTER_RECOVERY' => 'Blast Will and Testament',
            'EARN_MONEY_MED' => 'Spoils of War',
            'DEFUSE_DEFENSE' => 'Defusus Interruptus',
            'EARN_MONEY_HIGH' => 'Blood Money',
            'BOMB_PLANT_LOW' => 'Boomala Boomala',
            'KILL_ENEMY_TEAM' => 'The Cleaner',
            'BOMB_DEFUSE_LOW' => 'The Hurt Blocker',
            'LAST_PLAYER_ALIVE' => 'War of Attrition',
            'RESCUE_ALL_HOSTAGES' => 'Good Shepherd',
            'WIN_PISTOLROUNDS_LOW' => 'Piece Initiative',
            'KILL_HOSTAGE_RESCUER' => 'Dead Shepherd',
            'WIN_PISTOLROUNDS_MED' => 'Give Piece a Chance',
            'WIN_PISTOLROUNDS_HIGH' => 'Piece Treaty',
            'FAST_HOSTAGE_RESCUE' => 'Freed With Speed',
            'SILENT_WIN' => 'Black Bag Operation',
            'RESCUE_HOSTAGES_LOW' => 'Cowboy Diplomacy',
            'RESCUE_HOSTAGES_MED' => 'SAR Czar',
            'WIN_ROUNDS_WITHOUT_BUYING' => 'The Frugal Beret'
        ];
        $combatSkills = [
            'KILL_ENEMY_LOW' => 'Body Bagger',
            'PISTOL_ROUND_KNIFE_KILL' => 'Street Fighter',
            'KILL_ENEMY_MED' => 'Corpseman',
            'WIN_DUAL_DUEL' => 'Akimbo King',
            'KILL_ENEMY_HIGH' => 'God of War',
            'GRENADE_MULTIKILL' => 'Three the Hard Way',
            'KILL_ENEMY_RELOADING' => 'Shot With Their Pants Down',
            'KILL_WHILE_IN_AIR' => 'Death From Above',
            'KILLING_SPREE' => 'Ballistic',
            'KILL_ENEMY_IN_AIR' => 'Bunny Hunt',
            'KILLS_WITH_MULTIPLE_GUNS' => 'Variety Hour',
            'KILLER_AND_ENEMY_IN_AIR' => 'Aerial Necrobatics',
            'HEADSHOTS' => 'Battle Sight Zero',
            'KILL_WITH_OWN_GUN' => 'Lost and F0wnd',
            'SURVIVE_GRENADE' => 'Shrapnelproof',
            'KILL_TWO_WITH_ONE_SHOT' => 'Ammo Conservation',
            'KILL_ENEMY_BLINDED' => 'Blind Ambition',
            'GIVE_DAMAGE_LOW' => 'Points in Your Favor',
            'KILL_ENEMIES_WHILE_BLIND' => 'Blind Fury',
            'GIVE_DAMAGE_MED' => 'You Made Your Points',
            'KILL_ENEMIES_WHILE_BLIND_HARD' => 'Spray and Pray',
            'GIVE_DAMAGE_HIGH' => 'A Million Points of Blight',
            'KILLS_ENEMY_WEAPON' => 'Friendly Firearms',
            'KILL_ENEMY_LAST_BULLET' => 'Magic Bullet',
            'KILL_WITH_EVERY_WEAPON' => 'Expert Marksman',
            'KILLING_SPREE_ENDER' => 'Kill One, Get One Spree',
            'WIN_KNIFE_FIGHTS_LOW' => 'Make the Cut',
            'DAMAGE_NO_KILL' => 'Primer',
            'WIN_KNIFE_FIGHTS_HIGH' => 'The Bleeding Edge',
            'KILL_LOW_DAMAGE' => 'Finishing Schooled',
            'KILLED_DEFUSER_WITH_GRENADE' => 'Defuse This!',
            'SURVIVE_MANY_ATTACKS' => 'Target-Hardened',
            'KILL_SNIPER_WITH_SNIPER' => 'Eye to Eye',
            'UNSTOPPABLE_FORCE' => 'The Unstoppable Force',
            'KILL_SNIPER_WITH_KNIFE' => 'Sknifed',
            'IMMOVABLE_OBJECT' => 'The Immovable Object',
            'HIP_SHOT' => 'Hip Shot',
            'HEADSHOTS_IN_ROUND' => 'Head Shred Redemption',
            'KILL_SNIPERS' => 'Snipe Hunter',
            'CAUSE_FRIENDLY_FIRE_WITH_FLASHBANG' => 'The Road to Hell',
            'KILL_WHEN_AT_LOW_HEALTH' => 'Dead Man Stalking',
        ];
        $weaponSpecialist = [
            'KILL_ENEMY_DEAGLE' => 'Desert Eagle Expert',
            'KILL_ENEMY_UMP45' => 'UMP-45 Expert',
            'KILL_ENEMY_NOVA' => 'Nova Expert',
            'KILL_ENEMY_HKP2000' => 'P2000/USP Tactical Expert',
            'KILL_ENEMY_XM1014' => 'XM1014 Expert',
            'KILL_ENEMY_GLOCK' => 'Glock-18 Exper',
            'KILL_ENEMY_MAG7' => 'MAG-7 Expert',
            'KILL_ENEMY_P250' => '	P250 Expert',
            'KILL_ENEMY_M249' => 'M249 Expert',
            'KILL_ENEMY_ELITE' => 'Dual Berettas Expert',
            'KILL_ENEMY_NEGEV' => 'Negev Expert',
            'KILL_ENEMY_FIVESEVEN' => '	Five-SeveN Expert',
            'KILL_ENEMY_TEC9' => 'Tec-9 Expert',
            'KILL_ENEMY_AWP' => 'AWP Expert',
            'KILL_ENEMY_SAWEDOFF' => 'Sawed-Off Expert',
            'KILL_ENEMY_AK47' => 'AK-47 Expert',
            'KILL_ENEMY_BIZON' => 'PP-Bizon Expert',
            'KILL_ENEMY_M4A1' => 'M4 AR Expert',
            'KILL_ENEMY_KNIFE' => 'Knife Expert',
            'KILL_ENEMY_AUG' => 'AUG Expert',
            'KILL_ENEMY_HEGRENADE' => 'HE Grenade Expert',
            'KILL_ENEMY_SG556' => 'SG553 Expert',
            'KILL_ENEMY_MOLOTOV' => 'Flame Expert',
            'KILL_ENEMY_SCAR20' => 'SCAR-20 Expert',
            'DEAD_GRENADE_KILL' => 'Premature Burial',
            'KILL_ENEMY_GALILAR' => 'Galil AR Expert',
            'META_PISTOL' => 'Pistol Master',
            'META_RIFLE' => 'Rifle Master',
            'META_SMG' => 'Sub-Machine Gun Master',
            'META_SHOTGUN' => 'Shotgun Master',
            'META_WEAPONMASTER' => 'Master At Arms',
            'KILL_ENEMY_TASER' => 'Zeus x27 Expert',
            'KILL_ENEMY_FAMAS' => 'FAMAS Expert',
            'KILL_ENEMY_SSG08' => 'SSG 08 Expert',
            'KILL_ENEMY_G3SG1' => 'G3SG1 Expert',
            'KILL_ENEMY_P90' => 'P90 Expert',
            'KILL_ENEMY_MP7' => 'MP7 Expert',
            'KILL_ENEMY_MP9' => 'MP9 Expert',
            'KILL_ENEMY_MAC10' => 'MAC-10 Expert',
        ];
        $globalExpertise = [
            'WIN_MAP_CS_ITALY' => 'Italy Map Veteran',
            'WIN_MAP_AR_BAGGAGE' => 'Baggage Claimer',
            'WIN_MAP_CS_OFFICE' => 'Office Map Veteran',
            'WIN_MAP_DE_LAKE' => 'Vacation',
            'WIN_MAP_DE_SAFEHOUSE' => 'My House',
            'WIN_MAP_DE_AZTEC' => 'Aztec Map Veteran',
            'WIN_MAP_DE_SUGARCANE' => 'Run of the Mill',
            'WIN_MAP_DE_DUST' => 'Dust Map Veteran',
            'WIN_MAP_DE_STMARC' => 'Marcsman',
            'WIN_MAP_DE_DUST2' => 'Dust2 Map Veteran',
            'WIN_MAP_DE_BANK' => 'Bank On It',
            'WIN_MAP_DE_INFERNO' => 'Inferno Map Veteran',
            'WIN_MAP_DE_NUKE' => 'Nuke Map Veteran',
            'WIN_MAP_DE_SHORTTRAIN' => 'Shorttrain Map Veteran',
            'BREAK_WINDOWS' => 'A World of Pane',
            'WIN_MAP_DE_TRAIN' => 'Train Map Veteran',
            'WIN_MAP_AR_SHOOTS' => 'Shoots Vet'
        ];
        $armsRaceDemolition = [
            'GUN_GAME_ROUNDS_MED' => 'Gun Collector',
            'PLAY_EVERY_GUNGAME_MAP' => 'Tourist',
            'GUN_GAME_KILL_KNIFER' => 'Denied!',
            'GUN_GAME_ROUNDS_HIGH' => 'King of the Kill',
            'KILL_WITH_EVERY_WEAPON' => 'Marksman',
            'WIN_GUN_GAME_ROUNDS_LOW' => 'Gungamer',
            'WIN_GUN_GAME_ROUNDS_MED' => 'Keep on Gunning',
            'GUN_GAME_RAMPAGE' => 'Rampage!',
            'GUN_GAME_FIRST_KILL' => 'FIRST!',
            'WIN_GUN_GAME_ROUNDS_HIGH' => 'Kill of the Century',
            'ONE_SHOT_ONE_KILL' => 'One Shot One Kill',
            'WIN_GUN_GAME_ROUNDS_EXTREME' => 'The Professional',
            'GUN_GAME_CONSERVATIONIST' => 'Conservationist',
            'WIN_GUN_GAME_ROUNDS_ULTIMATE' => 'Cold Pizza Eater',
            'DOMINATIONS_LOW' => 'Repeat Offender',
            'TR_BOMB_PLANT_LOW' => 'Shorter Fuse',
            'DOMINATIONS_HIGH' => 'Decimator',
            'TR_BOMB_DEFUSE_LOW' => 'Quick Cut',
            'REVENGES_LOW' => 'Insurgent',
            'GUN_GAME_FIRST_THING_FIRST' => 'First Things First',
            'REVENGES_HIGH' => 'Cant Keep a Good Man Down',
            'GUN_GAME_TARGET_SECURED' => 'Target Secured',
            'DOMINATION_OVERKILLS_LOW' => 'Overkill',
            'BORN_READY' => 'Born Ready',
            'DOMINATION_OVERKILLS_HIGH' => 'Command and Control',
            'BASE_SCAMPER' => 'Base Scamper',
            'DOMINATION_OVERKILLS_MATCH' => 'Ten Angry Men',
            'GUN_GAME_KNIFE_KILL_KNIFER' => 'Knife on Knife',
            'EXTENDED_DOMINATION' => 'Excessive Brutality',
            'GUN_GAME_SMG_KILL_KNIFER' => 'Level Playing Field',
            'CONCURRENT_DOMINATIONS' => 'Hat Trick',
            'STILL_ALIVE' => 'Still Alive',
            'AVENGE_FRIEND' => 'Avenging Angel',
            'GUN_GAME_ROUNDS_LOW' => 'Practice Practice Practice',
        ];
        $armsRaceDemolitionUnachieved = $weaponSpecialistUnachieved = $globalExpertiseUnachieved =
        $combatSkillsUnachieved = $teamTacticsUnachieved = [];
        $i = $j = 0;
        $achived = 0;
        $noAchived = [];
        $arrayAchievements = [];
        for ($i = 0; $i < 167; $i++) {
            $arrayAchievements[$userAchievements[$i]->apiname] = [
                'displayName' => $gameAchievements[$i]->displayName,
                'description' => $gameAchievements[$i]->description,
                'icon' => $gameAchievements[$i]->icon,
                'icongray' => $gameAchievements[$i]->icongray,
                'achived' => $userAchievements[$i]->achieved,
                'unlocktime' => $userAchievements[$i]->unlocktime,
            ];
        }

        $achievementsData = [
            'array_Achievements' => $arrayAchievements,
            'game_Achievements' => $gameAchievements,
            'user_Achievements' => $userAchievements,
            'arms_Race_Demolition' => $armsRaceDemolition,
            'weapon_Specialist' => $weaponSpecialist,
            'global_Expertise' => $globalExpertise,
            'combat_Skills' => $combatSkills,
            'team_Tactics' => $teamTactics,
        ];
        return $achievementsData;
    }

    public static function prepareFPDFStatistic($player, $steamid)
    {
        $fpdfData = $userArray = $img = [];
        if (!$player) {
            $info = 'Korisnik sa Steam ID-om '.$steamid.' ne postoji!';
            $status = 0;
        } else {
            $urlUserStatForGame = self::getUserStatForGame($player);
            if (@file_get_contents($urlUserStatForGame) === false) {
                $info = 'Korisnik sa Steam ID-om '.$steamid.' ima privatne postavke svoga profila!';
                $status = 1;
            } else {
                $info = $player->personaname;
                $userStats = self::getUserStatForGame($player);
                $img = $player->avatarfull;
                $status = 2;
                foreach ($userStats->playerstats->stats as $stat) {
                    $userArray[$stat->name] = $stat->value;
                }
                $fpdfData[] = [

                ];
            }
        }
        $fpdfData = [
            'status' => $status,
            'info' => $info,
            'user_Array' => $userArray,
            'img' => $img,
        ];
        return $fpdfData;
    }

    public static function getPlayersComparison($userStats1, $userStats2)
    {
        $usersData = $userArray = $userArray2 = [];
        foreach ($userStats1->playerstats->stats as $stat) {
            $userArray[$stat->name] = $stat->value;
        }
        foreach ($userStats2->playerstats->stats as $stat) {
            $userArray2[$stat->name] = $stat->value;
        }
        $userStatsOne = $userStatsTwo = [];
        $userStatsOne[0] = $userArray['total_kills'];
        $userStatsOne[1] = $userArray['total_deaths'];
        $userStatsOne[2] = round($userArray['total_time_played']/3600);
        $userStatsOne[3] = $userArray['total_wins'];
        $userStatsOne[4] = $userArray['total_damage_done'];
        $userStatsOne[5] = $userArray['total_money_earned'];
        $userStatsOne[6] = $userArray['total_mvps'];
        $userStatsOne[7] = $userArray['total_contribution_score'];
        $userStatsOne[8] = $userArray['total_weapons_donated'];
        $userStatsOne[9] = $userArray['total_kills_headshot'];
        $userStatsOne[10] = $userArray['total_wins_pistolround'];
        $userStatsOne[11] = $userArray['total_kills_hegrenade'];
        $userStatsOne[12] = $userArray['total_kills_deagle'];
        $userStatsOne[13] = $userArray['total_kills_awp'];
        $userStatsOne[14] = $userArray['total_kills_molotov'];
        $userStatsOne[15] = $userArray['total_kills_m4a1'];
        $userStatsOne[16] = $userArray['total_kills_ak47'];
        $userStatsOne[17] = $userArray['total_kills_knife'];
        $userStatsOne[18] = $userArray['total_kills_taser'];
        $userStatsOne[19] = $userArray['total_broken_windows'];
        $userStatsOne[20] = round($userArray['total_gun_game_rounds_won']/$userArray['total_gun_game_rounds_played'],2);

        $userStatsTwo[0] = $userArray2['total_kills'];
        $userStatsTwo[1] = $userArray2['total_deaths'];
        $userStatsTwo[2] = round($userArray2['total_time_played']/3600);
        $userStatsTwo[3] = $userArray2['total_wins'];
        $userStatsTwo[4] = $userArray2['total_damage_done'];
        $userStatsTwo[5] = $userArray2['total_money_earned'];
        $userStatsTwo[6] = $userArray2['total_mvps'];
        $userStatsTwo[7] = $userArray2['total_contribution_score'];
        $userStatsTwo[8] = $userArray2['total_weapons_donated'];
        $userStatsTwo[9] = $userArray2['total_kills_headshot'];
        $userStatsTwo[10] = $userArray2['total_wins_pistolround'];
        $userStatsTwo[11] = $userArray2['total_kills_hegrenade'];
        $userStatsTwo[12] = $userArray2['total_kills_deagle'];
        $userStatsTwo[13] = $userArray2['total_kills_awp'];
        $userStatsTwo[14] = $userArray2['total_kills_molotov'];
        $userStatsTwo[15] = $userArray2['total_kills_m4a1'];
        $userStatsTwo[16] = $userArray2['total_kills_ak47'];
        $userStatsTwo[17] = $userArray2['total_kills_knife'];
        $userStatsTwo[18] = $userArray2['total_kills_taser'];
        $userStatsTwo[19] = $userArray2['total_broken_windows'];
        $userStatsTwo[20] = round($userArray2['total_gun_game_rounds_won']/$userArray2['total_gun_game_rounds_played'],2);

        $statNames[0] = 'Total kills';
        $statNames[1] = 'Total deaths';
        $statNames[2] = 'Time played';
        $statNames[3] = 'Wins';
        $statNames[4] = 'Damage done';
        $statNames[5] = 'Money earned';
        $statNames[6] = 'MVPs';
        $statNames[7] = 'Contribution score';
        $statNames[8] = 'Weapons donated';
        $statNames[9] = 'Headshots';
        $statNames[10] = 'Pistol round won';
        $statNames[11] = 'HE grande kills';
        $statNames[12] = 'Deagle kills';
        $statNames[13] = 'AWP kills';
        $statNames[14] = 'Molotov kills';
        $statNames[15] = 'M4A1 kills';
        $statNames[16] = 'AK47 kills';
        $statNames[17] = 'Knife kills';
        $statNames[18] = 'Teaser kills';
        $statNames[19] = 'Broken windows';
        $statNames[20] = 'Gun rounds won';

        $usersData = [
            'stat_names' => $statNames,
            'user_Stats_One' => $userStatsOne,
            'user_Stats_Two' => $userStatsTwo,
        ];
        return $usersData;
    }

    public static function checkForComparison()
    {
        if (!isset($_COOKIE['steamid-comparison_0']) || !isset($_COOKIE['steamid-comparison_1'])) {
            return false;
        } else {
            return true;
        }
    }

    public static function showSteamUserProfile($player)
    {
        $userStats = self::getUserStatForGame($player);
        if (!$userStats) {
            return [];
        }
        $totalKills['value'] = $totalWins['value'] = 0;
        $totalKills['name'] = $totalWins['name'] = '';
        foreach ($userStats->playerstats->stats as $stat) {
            if(strpos($stat->name,'total_kills_') !== false && $stat->name != 'total_kills_headshot' && $totalKills['value'] <= $stat->value) {
                $totalKills['name'] = $stat->name;
                $totalKills['value'] = $stat->value;
            }
            if(strpos($stat->name,'total_wins_map') !== false && $totalWins['value'] <= $stat->value) {
                $totalWins['name'] = $stat->name;
                $totalWins['value'] = $stat->value;
            }
            $userArray[$stat->name] = $stat->value;
        }
        $totalKills['name'] = substr($totalKills['name'], 12);
        $totalWins['name'] = substr($totalWins['name'], 15);
        $userData = [
            'total_kills' => $totalKills,
            'total_wins' => $totalWins,
            'user_Array' => $userArray,
        ];
        return $userData;
    }

    public static function searchPlayer($steamId)
    {
        $url = $obj = $player = '';
        if (is_numeric($steamId)) {
            $player = self::findSteamPlayerBySteamId($steamId);
        } else {
            // ako imamo samo ime -> hexerGOD
            if (!preg_match('/[\'^£$%&*()}{@#~?><>.,|=+¬-]/', $steamId)) {
                $string = file_get_contents("http://steamcommunity.com/id/".$steamId);
                if (strpos($string, 'steamid') !== false) {
                    $seedString = "steamid";
                    $sub= substr($string,strpos($string,$seedString)+10,17);
                    if (is_numeric($sub)) {
                        $player = self::findSteamPlayerBySteamId($sub);
                    }
                }
            }
            if (substr($steamId, -1) == '/') {
                $steamId = substr($steamId, 0, -1);
            }
            $s = strrpos($steamId, '/');
            $sub = substr($steamId, $s+1);

            if (is_numeric($sub)) {
                $player = self::findSteamPlayerBySteamId($sub);
            } else {
                $string = file_get_contents("http://steamcommunity.com/id/".$sub);
                if (strpos($string, 'steamid') !== false) {
                    $seedString = "steamid";
                    $sub= substr($string,strpos($string,$seedString)+10,17);
                    if (is_numeric($sub)) {
                        $player = self::findSteamPlayerBySteamId($sub);
                    }
                }
            }
        }
        return $player;
    }
}
