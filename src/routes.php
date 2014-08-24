<?php


Route::group(array('before' => 'auth'), function()
{
    Route::get('/', array('as' => 'home', 'uses' => APPCONTROLLERS . '\HomeController@showWelcome'));
});

Route::get('login', array('as' => 'login', 'uses' => APPCONTROLLERS . '\AuthController@login'));
Route::post('login', array('as' => 'attemptLogin', 'uses' => APPCONTROLLERS . '\AuthController@attemptLogin'));
Route::get('logout', array('as' => 'logout', 'uses' => APPCONTROLLERS . '\AuthController@logout'));