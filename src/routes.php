<?php


Route::group(array('before' => 'auth'), function()
{
    Route::get('/', array('as' => 'home', 'uses' => APPCONTROLLERS . '\SongsController@index'));

    Route::get('account', array('as' => 'account', 'uses' => APPCONTROLLERS . '\AuthController@account'));
    Route::put('account', array('as' => 'account.update', 'uses' => APPCONTROLLERS . '\AuthController@accountUpdate'));

    // Songs
    Route::group(array('prefix' => 'songs'), function()
    {
        //Route::get('/', array('as' => 'songs', 'uses' => APPCONTROLLERS . '\SongsController@index'));
        Route::get('create', array('as' => 'songs.create', 'uses' => APPCONTROLLERS . '\SongsController@create'));
        Route::post('/', array('as' => 'songs.store', 'uses' => APPCONTROLLERS . '\SongsController@store'));
        Route::get('{id}', array('as' => 'songs.show', 'uses' => APPCONTROLLERS . '\SongsController@show'));
        Route::get('{id}/edit', array('as' => 'songs.edit', 'uses' => APPCONTROLLERS . '\SongsController@edit'));
        Route::put('{id}', array('as' => 'songs.update', 'uses' => APPCONTROLLERS . '\SongsController@update'));
        Route::delete('{id}', array('as' => 'songs.destroy', 'uses' => APPCONTROLLERS . '\SongsController@destroy'));
    });
});

Route::get('login', array('as' => 'login', 'uses' => APPCONTROLLERS . '\AuthController@login'));
Route::post('login', array('as' => 'attemptLogin', 'uses' => APPCONTROLLERS . '\AuthController@attemptLogin'));
Route::get('logout', array('as' => 'logout', 'uses' => APPCONTROLLERS . '\AuthController@logout'));