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

Route::get('/forgot-password', 'ForgotPasswordController@index')->name('forgot_password.index');
Route::post('/forgot-password', 'ForgotPasswordController@store')->name('forgot_password.store');

Route::get('/recovery-password/{token}', 'RecoveryPasswordController@index')->name('recovery_password.index');
Route::post('/recovery-password/{token}', 'RecoveryPasswordController@store')->name('recovery_password.store');

Route::get('profile', 'ProfileController@edit')->name('profile.edit');
Route::put('profile', 'ProfileController@update')->name('profile.update');
Route::get('profile/change-password', 'PasswordController@index')->name('password.index');
Route::post('profile/change-password', 'PasswordController@store')->name('password.store');

Route::get('notifications/{id}', 'NotificationController@click')->name('notifications.click');

// CAMPAIGNS
Route::get('campaigns/me', 'CampaignController@me')->name('campaigns.me');
Route::get('campaigns/join/{token}', 'CampaignController@joinIndex')->name('campaigns.join.index');
Route::post('campaigns/join/{token}', 'CampaignController@joinStore')->name('campaigns.join.store');
Route::get('campaigns/{id}/create-link', 'CampaignController@linkIndex')->name('campaigns.link.index');
Route::get('campaigns/{id}/create-link/regenerate', 'CampaignController@linkRegenerate')->name('campaigns.link.regenerate');
Route::get('campaigns/{id}/create-link/disable', 'CampaignController@linkDisable')->name('campaigns.link.disable');
Route::resource('/campaigns', 'CampaignController');
Route::get('campaigns/{id}/remove', 'CampaignController@remove')->name('campaigns.remove');

Route::get('/campaigns/{id}/experiences-panel', 'ExperienceController@panel')->name('campaigns.experiences.panel');
Route::get('/campaigns/{id}/experiences', 'ExperienceController@index')->name('campaigns.experiences.index');
Route::post('/campaigns/{id}/experiences', 'ExperienceController@store')->name('campaigns.experiences.store');

// SESSIONS
Route::resource('sessions', 'SessionController');
Route::get('sessions/{id}/posts', 'SessionPostController@create')->name('sessions.posts.create');
Route::post('sessions/{id}/posts', 'SessionPostController@store')->name('sessions.posts.store');
Route::get('sessions-posts/{id}', 'SessionPostController@edit')->name('sessions.posts.edit');
Route::put('sessions-posts/{id}', 'SessionPostController@update')->name('sessions.posts.update');
Route::get('sessions-posts/{id}/remove', 'SessionPostController@remove')->name('sessions.posts.remove');

// SESSIONS ADMIN
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

// MAPS
// MAPS
Route::resource('maps', 'MapController');

// HOMEBREWS
Route::resource('homebrews', 'HomebrewController');
Route::get('homebrews/{id}/remove', 'HomebrewController@remove')->name('homebrews.remove');
Route::get('campaigns/{id}/homebrews', 'HomebrewController@index')->name('campaigns.homebrews.index');

Route::resource('knowledges', 'KnowledgeController');

// CANALES
Route::resource('channels', 'ChannelController');
Route::get('channels/{id}/suscribe', 'ChannelController@suscribe')->name('channels.suscribe');
Route::get('channels/{id}/unsuscribe', 'ChannelController@unsuscribe')->name('channels.unsuscribe');
Route::get('channels/{id}/remove', 'ChannelController@remove')->name('channels.remove');
Route::get('channels/{id}/open', 'ChannelController@open')->name('channels.open');
Route::get('channels/{id}/close', 'ChannelController@close')->name('channels.close');
Route::get('channels/{id}/last-post', 'ChannelController@lastPost');
Route::get('campaigns/{id}/channels', 'ChannelController@index')->name('campaigns.channels.index');
Route::get('channels/{id}/create-post', 'PostController@create')->name('channels.posts.create');
Route::post('channels/{id}/create-post', 'PostController@store')->name('channels.posts.store');
Route::get('channels/{id}/roll-dices', 'PostController@createDices')->name('channels.dices.create');
Route::post('channels/{id}/roll-dices', 'PostController@storeDices')->name('channels.dices.store');

Route::get('channels/{id}/remove', 'ChannelController@remove')->name('channels.remove');

Route::get('posts/{id}', 'PostController@edit')->name('posts.edit');
Route::put('posts/{id}', 'PostController@update')->name('posts.update');

// CHARACTERS
Route::get('characters/me', 'CharacterController@me')->name('characters.me');
Route::post('characters/{id}/class', 'CharacterController@addClass')->name('characters.addclass');
Route::get('characters/{id}/class/{class_id}/delete', 'CharacterController@removeClass')->name('characters.removeclass');
Route::resource('/characters', 'CharacterController');
Route::get('/characters/{id}/remove', 'CharacterController@destroy')->name('characters.remove');

Route::get('characters/{id}/edit-dm', 'CharacterController@editDm')->name('characters.dm.edit');
Route::put('characters/{id}/edit-dm', 'CharacterController@updateDm')->name('characters.dm.update');

Route::get('search', 'SearchController@index')->name('search');

// USERS
Route::resource('/users', 'UserController');
