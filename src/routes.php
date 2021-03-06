<?php


Route::group(['before' => 'auth'], function () {
    Route::get('/', ['as' => 'home', 'uses' => APPCONTROLLERS . '\SongsController@index']);

    Route::get('account', ['as' => 'account', 'uses' => APPCONTROLLERS . '\AuthController@account']);
    Route::put('account', ['as' => 'account.update', 'uses' => APPCONTROLLERS . '\AuthController@accountUpdate']);

    // Songs
    Route::group(['prefix' => 'songs'], function () {
        //Route::get('/', ['as' => 'songs', 'uses' => APPCONTROLLERS . '\SongsController@index']);
        Route::get('deleted', ['as' => 'songs.deleted', 'uses' => APPCONTROLLERS . '\SongsController@deleted']);
        Route::get('create', ['as' => 'songs.create', 'uses' => APPCONTROLLERS . '\SongsController@create']);
        Route::post('/', ['as' => 'songs.store', 'uses' => APPCONTROLLERS . '\SongsController@store']);
        Route::get('{id}', ['as' => 'songs.show', 'uses' => APPCONTROLLERS . '\SongsController@show']);
        Route::get('{id}/edit', ['as' => 'songs.edit', 'uses' => APPCONTROLLERS . '\SongsController@edit']);
        Route::get('{id}/download', ['as' => 'songs.download', 'uses' => APPCONTROLLERS . '\SongsController@download']);
        Route::put('{id}/restore', ['as' => 'songs.restore', 'uses' => APPCONTROLLERS . '\SongsController@restore']);
        Route::put('{id}/category', ['as' => 'songs.category', 'uses' => APPCONTROLLERS . '\SongsController@category']);
        Route::put('{id}/reset', ['as' => 'songs.reset', 'uses' => APPCONTROLLERS . '\SongsController@reset']);
        Route::put('{id}', ['as' => 'songs.update', 'uses' => APPCONTROLLERS . '\SongsController@update']);
        Route::delete('{id}/force', ['as' => 'songs.force', 'uses' => APPCONTROLLERS . '\SongsController@forceDestroy']);
        Route::delete('{id}', ['as' => 'songs.destroy', 'uses' => APPCONTROLLERS . '\SongsController@destroy']);
    });

    // Votes
    Route::group(['prefix' => 'votes'], function () {
        Route::post('{songId}', ['as' => 'votes.store', 'uses' => APPCONTROLLERS . '\VotesController@store']);
    });

    // Comments
    Route::group(['prefix' => 'comments'], function () {
        Route::post('{songId}', ['as' => 'comments.store', 'uses' => APPCONTROLLERS . '\CommentsController@store']);
    });

    // Follows
    Route::group(['prefix' => 'follows'], function () {
        Route::post('{songId}', ['as' => 'follows.store', 'uses' => APPCONTROLLERS . '\FollowsController@store']);
    });

    // Api
    Route::group(['prefix' => 'api'], function () {
        Route::get('bands', ['as' => 'bands', 'uses' => APICONTROLLERS . '\BandsController@index']);
    });
});

Route::group(['before' => 'auth.admin'], function () {
    // Users
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', ['as' => 'users', 'uses' => APPCONTROLLERS . '\UsersController@index']);
        Route::get('deleted', ['as' => 'users.deleted', 'uses' => APPCONTROLLERS . '\UsersController@deleted']);
        Route::get('create', ['as' => 'users.create', 'uses' => APPCONTROLLERS . '\UsersController@create']);
        Route::post('/', ['as' => 'users.store', 'uses' => APPCONTROLLERS . '\UsersController@store']);
        Route::get('{id}/edit', ['as' => 'users.edit', 'uses' => APPCONTROLLERS . '\UsersController@edit']);
        Route::put('{id}/restore', ['as' => 'users.restore', 'uses' => APPCONTROLLERS . '\UsersController@restore']);
        Route::put('{id}', ['as' => 'users.update', 'uses' => APPCONTROLLERS . '\UsersController@update']);
        Route::delete('{id}/force', ['as' => 'users.force', 'uses' => APPCONTROLLERS . '\UsersController@forceDestroy']);
        Route::delete('{id}', ['as' => 'users.destroy', 'uses' => APPCONTROLLERS . '\UsersController@destroy']);
    });

    // Emails...for visual testing
    Route::group(['prefix' => 'email'], function () {
        Route::get('suggest', APPCONTROLLERS . '\EmailsController@suggest');
        Route::get('activity', APPCONTROLLERS . '\EmailsController@activity');
        Route::get('password', APPCONTROLLERS . '\EmailsController@password');
    });
});

// Authentication
Route::get('login', ['as' => 'login', 'uses' => APPCONTROLLERS . '\AuthController@login']);
Route::post('login', ['as' => 'attemptLogin', 'uses' => APPCONTROLLERS . '\AuthController@attemptLogin']);
Route::get('logout', ['as' => 'logout', 'uses' => APPCONTROLLERS . '\AuthController@logout']);

// Password reset functionality
Route::controller('password', APPCONTROLLERS . '\RemindersController');

// Message Queues
Route::post('queue/receive', function () {
    return Queue::marshal();
});
