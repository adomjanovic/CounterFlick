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
Route::post('/', 'SteamController@index');
Route::get('/{steamid}', 'SteamController@show');
Route::get('/{steamid}/profile', 'SteamController@profile');

Route::get('/{steamid}', [ 'as'=>'steam-user', 'uses'=>'SteamController@edit']);
Route::get('/{steamid}/maps', [ 'as'=>'steam-user-maps', 'uses'=>'SteamController@showMaps']);
Route::get('/{steamid}/weapons', [ 'as'=>'steam-user-weapons', 'uses'=>'SteamController@showWeapons']);
Route::get('/{steamid}/achievements', [ 'as'=>'steam-user-achievements', 'uses'=>'SteamController@showAchievements']);

Route::get('/comparison/{steamid1?}', ['as' =>'steam-user-comparison', 'uses'=>'SteamController@comparison']);
