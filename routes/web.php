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

Route::get('/', 'IndexController@index')->name('index');
Route::get('/register', 'RegisterController@index')->name('register.index');
Route::post('/register', 'RegisterController@register')->name('register');
Route::get('/register/{token}', 'RegisterController@check')->name('register.check');
Route::get('/login', 'LoginController@index')->name('login.index');
Route::post('/login', 'LoginController@login')->name('login');
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::get('profile', 'ProfileController@show')->name('profile.show');

// CAMPAIGNS
Route::get('campaigns/me', 'CampaignController@me')->name('campaigns.me');
Route::get('campaigns/join/{token}', 'CampaignController@joinIndex')->name('campaigns.join.index');
Route::post('campaigns/join/{token}', 'CampaignController@joinStore')->name('campaigns.join.store');
Route::get('campaigns/{id}/create-link', 'CampaignController@linkIndex')->name('campaigns.link.index');
Route::get('campaigns/{id}/create-link/regenerate', 'CampaignController@linkRegenerate')->name('campaigns.link.regenerate');
Route::get('campaigns/{id}/create-link/disable', 'CampaignController@linkDisable')->name('campaigns.link.disable');
Route::resource('/campaigns', 'CampaignController');

// SESSIONS
Route::resource('sessions', 'SessionController');
Route::get('sessions/{id}/assign-characters', 'SessionController@showAssignments')->name('sessions.assignments.index');
Route::post('sessions/{id}/assign-characters', 'SessionController@storeAssignments')->name('sessions.assignments.store');
Route::get('sessions/{id}/assign-characters/{npc_id}/delete', 'SessionController@deleteAssignments')->name('sessions.assignments.delete');
Route::get('sessions/{id}/milestones', 'SessionController@indexMilestones')->name('sessions.milestones.index');
Route::post('sessions/{id}/milestones', 'SessionController@storeMilestones')->name('sessions.milestones.store');
Route::get('sessions/{id}/milestones/{milestone_id}/delete', 'SessionController@deleteMilestones')->name('sessions.milestones.delete');
Route::get('campaigns/{id}/sessions', 'SessionController@index')->name('campaigns.sessions.index');

Route::get('sessions/{id}/vote-positive', 'VoteController@positive')->name('sessions.vote.positive');
Route::get('sessions/{id}/vote-negative', 'VoteController@negative')->name('sessions.vote.negative');;

// NPCS
Route::resource('npcs', 'NpcController');
Route::get('campaigns/{id}/npcs', 'NpcController@index')->name('campaigns.npcs.index');

// CHARACTERS
Route::get('characters/me', 'CharacterController@me')->name('characters.me');
Route::resource('/characters', 'CharacterController');

// USERS
Route::resource('/users', 'UserController');

Route::view('/partidas', 'modules.campaigns.partidas');
Route::view('/partida', 'modules.campaigns.partida');
Route::view('/sesiones', 'modules.campaigns.sessions');
Route::view('/sesion', 'modules.campaigns.session');
Route::view('/homebrews', 'modules.campaigns.homebrews');
Route::view('/homebrew', 'modules.campaigns.homebrew');
