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

# docker container exec -it php1 /bin/bash

Route::get('/', function () {
    return view('welcome');
});


Route::get('/auth/login/sysadmin', [
    'as' => 'auth.login.index',
    'uses' => 'Auth\LoginController@index'
]);

Route::post('auth/login/authenticate', [
    'as' => 'auth.login.authenticate',
    'uses' => 'Auth\LoginController@authenticate'
]);

Route::group(['prefix' => 'sysadmin', 'middleware' => 'auth'], function() {

    Route::get('auth/logout', [
        'as' => 'sysadmin.auth.logout',
        'uses' => 'Auth\LoginController@logout'
    ]);

    Route::get('dashboard',[
        'as' => 'sysadmin.dashboard.index',
        'uses' => 'Sysadmin\DashboardController@index'
    ]);

    Route::group(['prefix' => 'user_group'], function() {
        
        Route::get('/', [
            'as' => 'sysadmin.user_group.index',
            'uses' => 'Sysadmin\UserGroupController@index'
        ]);

        Route::get('form/{userGroup?}', [
            'as' => 'sysadmin.user_group.form',
            'uses' => 'Sysadmin\UserGroupController@form'
        ]);

        Route::post('store/{userGroup?}', [
            'as' => 'sysadmin.user_group.store',
            'uses' => 'Sysadmin\UserGroupController@store'
        ]);

        Route::get('delete/{userGroup}', [
            'as' => 'sysadmin.user_group.delete',
            'uses' => 'Sysadmin\UserGroupController@delete'
        ]);

    });

    Route::group(['prefix' => 'user'], function() {
        
        Route::get('/', [
            'as' => 'sysadmin.user.index',
            'uses' => 'Sysadmin\UserController@index'
        ]);

        Route::get('form/{user?}', [
            'as' => 'sysadmin.user.form',
            'uses' => 'Sysadmin\UserController@form'
        ]);

        Route::post('store/{user?}', [
            'as' => 'sysadmin.user.store',
            'uses' => 'Sysadmin\UserController@store'
        ]);

        Route::get('delete/{user}', [
            'as' => 'sysadmin.user.delete',
            'uses' => 'Sysadmin\UserController@delete'
        ]);

    });
});
