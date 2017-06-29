@extends('layouts.master')
@section('content')
<div class="show-profile">
    @php
    $uri = explode('/', $_SERVER['REQUEST_URI']);
    $steamid = $uri[2];
    $url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=23E38BACEF40A739B05B305A8487184C&steamids='.$steamid;
    $json = file_get_contents($url);
    $obj = json_decode($json);
    $player = $obj->response->players;
    if (!$player) {
        @endphp
        <p>Korisnik sa Steam ID-om {{ $steamid }} ne postoji!</p>
        @php
    } else {
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
        $armsRaceDemolitionUnachieved = $weaponSpecialistUnachieved = $globalExpertiseUnachieved = $combatSkillsUnachieved = $teamTacticsUnachieved = [];

        $player = $player[0];
        $country = isset($player->loccountrycode) ? strtolower($player->loccountrycode) : '';
        $date = date('d.m.Y', $player->lastlogoff);
        @endphp
        <div class="show-profile-full">
            <img src="{{ $player->avatarmedium }}" >
            <a href="{{route('steam-user',[$player->steamid])}}"><h3>Back to profile stats</h3></a>
            <h5>{{ $player->personaname }} | Last online: {{ $date }}</h5>
        </div>
        @php
        $urlGameAchievements = 'http://api.steampowered.com/ISteamUserStats/GetSchemaForGame/v2/?key=23E38BACEF40A739B05B305A8487184C&appid=730';
        $urlUserAchievements = 'http://api.steampowered.com/ISteamUserStats/GetPlayerAchievements/v0001/?appid=730&key=23E38BACEF40A739B05B305A8487184C&steamid='.$steamid;
        $jsonUser = file_get_contents($urlUserAchievements);
        $objUser = json_decode($jsonUser);
        $json = file_get_contents($urlGameAchievements);
        $obj = json_decode($json);
        $userAchievements = $objUser->playerstats->achievements;
        $gameAchievements = $obj->game->availableGameStats->achievements;
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
    @endphp
        <div class="tab">
          <button class="tablinks" onclick="showAchievements(event, 'All')">All</button>
          <button class="tablinks" onclick="showAchievements(event, 'Team Tactics')">Team Tactics</button>
          <button class="tablinks" onclick="showAchievements(event, 'Combat Skills')">Combat Skills</button>
          <button class="tablinks" onclick="showAchievements(event, 'Weapon Specialist')">Weapon Specialist</button>
          <button class="tablinks" onclick="showAchievements(event, 'Global Expertise')">Global Expertise</button>
          <button class="tablinks" onclick="showAchievements(event, 'Arms Race')">Arms Race and Demolition</button>
        </div>

        <div id="All" class="tabcontent">
          <ol class="all-results">
          @php
          $i = 0;
            foreach ($gameAchievements as $achievements) {
                if ($userAchievements[$i]->apiname == $achievements->name ){
                    if ($userAchievements[$i]->achieved == 1) {
                        $achived++;
                        @endphp
                        <li class="item-achievement">
                            <img src="{{ $achievements->icon }}" alt=""><h5>{{ $achievements->displayName }}</h5>
                            <b>{{ date('d.M.Y', $userAchievements[$i]->unlocktime) }}</b>
                        </li>
                        @php
                    } else {
                      $noAchived[$j] = $achievements;
                      $j++;
                    }
                }
              $i++;
            }
        }
        foreach ($noAchived as $achievements) {
            @endphp
            <li class="item-achievement">
                <img src="{{ $achievements->icongray }}" alt=""><h5>{{ $achievements->displayName }}</h5>
            </li>
            @php
        }
        @endphp
        </ol>
    </div>

        <div id="Team Tactics" class="tabcontent">
        <ol class="all-results">
          @php
            foreach ($teamTactics as $key => $value) {
                if ($arrayAchievements[$key]['achived']) {
                @endphp
                <li class="item-achievement">
                    <img src="{{ $arrayAchievements[$key]['icon'] }}" alt="{{ $arrayAchievements[$key]['description'] }}">
                    <h5>{{ $arrayAchievements[$key]['displayName'] }}</h5>
                    <b>{{ date('d.M.Y', $arrayAchievements[$key]['unlocktime']) }}</b>
                </li>
                @php } else {
                    $teamTacticsUnachieved[$key] = [
                        'icongray' => $arrayAchievements[$key]['icongray'],
                        'description' => $arrayAchievements[$key]['description'],
                        'displayName' => $arrayAchievements[$key]['displayName']
                    ];
                }
            }
            foreach ($teamTacticsUnachieved as $key => $value) {
                @endphp
                <li class="item-achievement">
                    <img src="{{ $teamTacticsUnachieved[$key]['icongray'] }}" alt="{{ $teamTacticsUnachieved[$key]['description'] }}">
                    <h5>{{ $teamTacticsUnachieved[$key]['displayName'] }}</h5>
                </li>
                @php
            }
          @endphp
        </ol>
        </div>

        <div id="Combat Skills" class="tabcontent">
        <ol class="all-results">
          @php
            foreach ($combatSkills as $key => $value) {
                if ($arrayAchievements[$key]['achived']) {
                @endphp
                <li class="item-achievement">
                    <img src="{{ $arrayAchievements[$key]['icon'] }}" alt="{{ $arrayAchievements[$key]['description'] }}">
                    <h5>{{ $arrayAchievements[$key]['displayName'] }}</h5>
                    <b>{{ date('d.M.Y', $arrayAchievements[$key]['unlocktime']) }}</b>
                </li>
                @php } else {
                    $combatSkillsUnachieved[$key] = [
                        'icongray' => $arrayAchievements[$key]['icongray'],
                        'description' => $arrayAchievements[$key]['description'],
                        'displayName' => $arrayAchievements[$key]['displayName']
                    ];
                }
            }
            foreach ($combatSkillsUnachieved as $key => $value) {
                @endphp
                <li class="item-achievement">
                    <img src="{{ $combatSkillsUnachieved[$key]['icongray'] }}" alt="{{ $combatSkillsUnachieved[$key]['description'] }}">
                    <h5>{{ $combatSkillsUnachieved[$key]['displayName'] }}</h5>
                </li>
                @php
            }
          @endphp
        </ol>
        </div>

        <div id="Weapon Specialist" class="tabcontent">
        <ol class="all-results">
          @php
            foreach ($weaponSpecialist as $key => $value) {
                if ($arrayAchievements[$key]['achived']) {
                @endphp
                <li class="item-achievement">
                    <img src="{{ $arrayAchievements[$key]['icon'] }}" alt="{{ $arrayAchievements[$key]['description'] }}">
                    <h5>{{ $arrayAchievements[$key]['displayName'] }}</h5>
                    <b>{{ date('d.M.Y', $arrayAchievements[$key]['unlocktime']) }}</b>
                </li>
                @php } else {
                    $weaponSpecialistUnachieved[$key] = [
                        'icongray' => $arrayAchievements[$key]['icongray'],
                        'description' => $arrayAchievements[$key]['description'],
                        'displayName' => $arrayAchievements[$key]['displayName']
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
        </div>
        <div id="Global Expertise" class="tabcontent">
        <ol class="all-results">
          @php
            foreach ($globalExpertise as $key => $value) {
                if ($arrayAchievements[$key]['achived']) {
                @endphp
                <li class="item-achievement">
                    <img src="{{ $arrayAchievements[$key]['icon'] }}" alt="{{ $arrayAchievements[$key]['description'] }}">
                    <h5>{{ $arrayAchievements[$key]['displayName'] }}</h5>
                    <b>{{ date('d.M.Y', $arrayAchievements[$key]['unlocktime']) }}</b>
                </li>
                @php } else {
                    $globalExpertiseUnachieved[$key] = [
                        'icongray' => $arrayAchievements[$key]['icongray'],
                        'description' => $arrayAchievements[$key]['description'],
                        'displayName' => $arrayAchievements[$key]['displayName']
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
        </div>
        <div id="Arms Race" class="tabcontent">
        <ol class="all-results">
          @php
            foreach ($armsRaceDemolition as $key => $value) {
                if ($arrayAchievements[$key]['achived']) {
                @endphp
                <li class="item-achievement">
                    <img src="{{ $arrayAchievements[$key]['icon'] }}" alt="{{ $arrayAchievements[$key]['description'] }}">
                    <h5>{{ $arrayAchievements[$key]['displayName'] }}</h5>
                    <b>{{ date('d.M.Y', $arrayAchievements[$key]['unlocktime']) }}</b>
                </li>
                @php } else {
                    $armsRaceDemolitionUnachieved[$key] = [
                        'icongray' => $arrayAchievements[$key]['icongray'],
                        'description' => $arrayAchievements[$key]['description'],
                        'displayName' => $arrayAchievements[$key]['displayName']
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
        </div>
        <script>
        function showAchievements(evt, category) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(category).style.display = "block";
            evt.currentTarget.className += " active";
        }
        </script>
    </div>

@endsection
