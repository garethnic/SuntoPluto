<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/confirmation/{username}/{token}', ['uses' => 'UserController@confirmUser', 'as' => 'confirm_user']);

    Route::get('/home', 'HomeController@index');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/boards', ['uses' => 'BoardController@index']);
        Route::get('boards/new-board', ['uses' => 'BoardController@createBoard']);
        Route::post('/boards/create', ['uses' => 'BoardController@postBoard']);
        Route::post('/boards/add-new-member', ['uses' => 'BoardController@addMemberToBoard']);
        Route::get('/boards/{identifier}/tasks', ['uses' => 'BoardController@boardTasks', 'as' => 'tasks.index']);

        Route::get('/invites', ['uses' => 'InviteController@index']);
        Route::get('/invites/{board}/accept', ['uses' => 'InviteController@acceptInvite', 'as' => 'accept.invite']);
        Route::get('/invites/{board}/decline', ['uses' => 'InviteController@declineInvite', 'as' => 'decline.invite']);

        //Route::get('/tasks', ['uses' => 'TaskController@index']);
        Route::post('/tasks/all_json', ['uses' => 'TaskController@getTasksJson']);
        Route::post('/tasks/add-task', ['uses' => 'TaskController@addTask']);
        Route::delete('/tasks/remove-task', ['uses' => 'TaskController@removeTask']);
        Route::post('/tasks/complete-task', ['uses' => 'TaskController@completeTask']);
        Route::post('/tasks/assign-task', ['uses' => 'TaskController@assignTask']);

        Route::post('/members', ['uses' => 'BoardController@getBoardMembers']);
    });
});
