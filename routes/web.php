<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',  [ 'as'=>'main-page', 'uses'=>'SteamController@index']);
Route::post('/', [ 'as'=>'main-page', 'uses'=>'SteamController@findPlayer']);
Route::get('/{steamid}', [ 'as'=>'steam-user', 'uses'=>'SteamController@show']);
Route::get('/{steamid}/maps', [ 'as'=>'steam-user-maps', 'uses'=>'SteamController@showMaps']);
Route::get('/{steamid}/weapons', [ 'as'=>'steam-user-weapons', 'uses'=>'SteamController@showWeapons']);
Route::get('/{steamid}/achievements', [ 'as'=>'steam-user-achievements', 'uses'=>'SteamController@showAchievements']);
Route::get('/comparison/{steamid?}', ['as' =>'steam-user-comparison', 'uses'=>'SteamController@comparison']);
Route::get('/steam/logout', ['as' => 'steam-logout', 'uses' => 'SteamController@logout']);
Route::get('/steam/pdf/{steamid?}', ['as' => 'steam-pdf-generate', 'uses' => 'SteamController@generatePdf']);
Route::get('/steam/graph/{steamid?}', ['as' => 'steam-stats-graph', 'uses' => 'SteamController@showStatsGraph']);
