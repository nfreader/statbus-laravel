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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/rounds',function(){})->name('index');

Route::prefix('rounds')->name('rounds.')->group(function(){

  Route::get('/','RoundController@index')
    ->name('listing');

  Route::get('/{id}/', 'RoundController@single')
    ->where([
      'id'=>'[0-9]+'
    ])
    ->name('id');
  
  Route::get('/{id}/{stat}', 'RoundController@singleStat')
    ->where([
        'id'   => '[0-9]+',
        'stat' => '[a-z_]+'
    ])
    ->name('stat');
});

Route::prefix('deaths')->name('deaths.')->group(function(){

  Route::get('/', 'DeathController@getListing')
    ->name('listing');

  Route::get('/finalwords', 'DeathController@finalWords')
    ->name('finalwords');

  Route::get('/{id}', 'DeathController@getDeath')
    ->where([
      'death'   => '[0-9]+',
    ])
    ->name('single');

  Route::get('/round/{id}', 'DeathController@getDeathsForRound')
    ->where([
      'round'   => '[0-9]+',
    ])
    ->name('round');
});

Route::get('/who', function(){
  return redirect('/me');
});

Route::prefix('me')->group(function(){
  Route::get('/', 'MeController@getMe')
    ->name('me');
    
  Route::get('/auth', 'RemoteAuthController@remoteAuth')
    ->name('auth');
  Route::get('/auth/2', 'RemoteAuthController@remoteAuthRedirect')
    ->name('auth.2');

  Route::get('/auth/3', 'RemoteAuthController@finishRemoteAuth')
    ->name('auth.3');
});

Route::prefix('tgdb')->middleware(['usersession'])->group(function(){
  Route::get('/player/{ckey}', 'tgdbController@getPlayer')
    ->where([
      'ckey' => '[a-z]+'
    ])
    ->name('tgdb.player');
});
