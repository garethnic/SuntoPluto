<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::group(['prefix' => 'admin'], function () {
        Route::get('login', ['uses' => 'Auth\AdminAuthController@showLoginForm']);
        Route::post('login', ['uses' => 'Auth\AdminAuthController@login']);
        Route::get('logout', ['uses' => 'Auth\AdminAuthController@logout']);

        Route::group(['middleware' => 'auth:admin'], function () {
           Route::get('dashboard', ['uses' => 'AdminController@showDashboard']);
        });
    });

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

        Route::get('/{identifier}/reports', ['uses' => 'ReportController@index', 'as' => 'reports.index']);
        Route::get('/{identifier}/reports/all-tasks', ['uses' => 'ReportController@allTasks', 'as' => 'reports.all_tasks']);
        Route::get('/{identifier}/reports/completed-tasks', ['uses' => 'ReportController@completedTasks', 'as' => 'reports.completed_tasks']);
        Route::get('/{identifier}/reports/deleted-tasks', ['uses' => 'ReportController@deletedTasks', 'as' => 'reports.deleted_tasks']);
    });
});
