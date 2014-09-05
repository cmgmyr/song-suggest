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

    // Votes
    Route::group(array('prefix' => 'votes'), function()
    {
        Route::post('{songId}', array('as' => 'votes.store', 'uses' => APPCONTROLLERS . '\VotesController@store'));
    });

    // Comments
    Route::group(array('prefix' => 'comments'), function()
    {
        Route::post('{songId}', array('as' => 'comments.store', 'uses' => APPCONTROLLERS . '\CommentsController@store'));
    });
});

Route::group(array('before' => 'auth.admin'), function()
{
    // Users
    Route::group(array('prefix' => 'users'), function()
    {
        Route::get('/', array('as' => 'users', 'uses' => APPCONTROLLERS . '\UsersController@index'));
        Route::get('create', array('as' => 'users.create', 'uses' => APPCONTROLLERS . '\UsersController@create'));
        Route::post('/', array('as' => 'users.store', 'uses' => APPCONTROLLERS . '\UsersController@store'));
        Route::get('{id}/edit', array('as' => 'users.edit', 'uses' => APPCONTROLLERS . '\UsersController@edit'));
        Route::put('{id}', array('as' => 'users.update', 'uses' => APPCONTROLLERS . '\UsersController@update'));
        Route::delete('{id}', array('as' => 'users.destroy', 'uses' => APPCONTROLLERS . '\UsersController@destroy'));
    });
});

Route::get('login', array('as' => 'login', 'uses' => APPCONTROLLERS . '\AuthController@login'));
Route::post('login', array('as' => 'attemptLogin', 'uses' => APPCONTROLLERS . '\AuthController@attemptLogin'));
Route::get('logout', array('as' => 'logout', 'uses' => APPCONTROLLERS . '\AuthController@logout'));