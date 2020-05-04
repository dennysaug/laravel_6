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

Route::group(['prefix' => 'sysadmin', 'middleware' => ['auth','permission']], function() {

    Route::get('auth/logout', [
        'as' => 'sysadmin.auth.logout',
        'uses' => 'Auth\LoginController@logout'
    ]);

    Route::get('dashboard',[
        'as' => 'sysadmin.dashboard.index',
        'uses' => 'Sysadmin\DashboardController@index'
    ]);
/*
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
*/


    Route::group(['prefix' => 'user_group'], function() {

        Route::get('/', [
            'as' => 'sysadmin.user_group.index',
            'uses' => 'Sysadmin\UserGroupController@index'
        ]);

        Route::get('new', [
            'as' => 'sysadmin.user_group.new',
            'uses' => 'Sysadmin\UserGroupController@new'
        ]);

        Route::get('edit/{userGroup}', [
            'as' => 'sysadmin.user_group.edit',
            'uses' => 'Sysadmin\UserGroupController@edit'
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

        Route::get('new', [
            'as' => 'sysadmin.user.new',
            'uses' => 'Sysadmin\UserController@new'
        ]);

        Route::get('edit/{user}', [
            'as' => 'sysadmin.user.edit',
            'uses' => 'Sysadmin\UserController@edit'
        ]);

        Route::post('store/{user?}', [
            'as' => 'sysadmin.user.store',
            'uses' => 'Sysadmin\UserController@store'
        ]);

        Route::get('delete/{user}', [
            'as' => 'sysadmin.user.delete',
            'uses' => 'Sysadmin\UserController@delete'
        ]);

        Route::match(['get','post'],'permission/{user}', [
            'as' => 'sysadmin.user.permission',
            'uses' => 'Sysadmin\UserController@permission'
        ]);

    });


    Route::group(['prefix' => 'area'], function() {

        Route::get('/', [
            'as' => 'sysadmin.area.index',
            'uses' => 'Sysadmin\AreaController@index'
        ]);

        Route::get('new', [
            'as' => 'sysadmin.area.new',
            'uses' => 'Sysadmin\AreaController@new'
        ]);

        Route::get('edit/{area}', [
            'as' => 'sysadmin.area.edit',
            'uses' => 'Sysadmin\AreaController@edit'
        ]);

        Route::post('store/{area?}', [
            'as' => 'sysadmin.area.store',
            'uses' => 'Sysadmin\AreaController@store'
        ]);

        Route::get('delete/{area}', [
            'as' => 'sysadmin.area.delete',
            'uses' => 'Sysadmin\AreaController@delete'
        ]);

    });



    Route::group(['prefix' => 'role_group'], function() {

        Route::get('/', [
            'as' => 'sysadmin.role_group.index',
            'uses' => 'Sysadmin\RoleGroupController@index'
        ]);

        Route::get('edit/{userGroup}', [
            'as' => 'sysadmin.role_group.edit',
            'uses' => 'Sysadmin\RoleGroupController@edit'
        ]);

        Route::post('store/{userGroup?}', [
            'as' => 'sysadmin.role_group.store',
            'uses' => 'Sysadmin\RoleGroupController@store'
        ]);

    });


    Route::group(['prefix' => 'category'], function() {

        Route::get('/', [
            'as' => 'sysadmin.category.index',
            'uses' => 'Sysadmin\CategoryController@index'
        ]);

        Route::get('new', [
            'as' => 'sysadmin.category.new',
            'uses' => 'Sysadmin\CategoryController@new'
        ]);

        Route::get('edit/{category}', [
            'as' => 'sysadmin.category.edit',
            'uses' => 'Sysadmin\CategoryController@edit'
        ]);

        Route::post('store/{category?}', [
            'as' => 'sysadmin.category.store',
            'uses' => 'Sysadmin\CategoryController@store'
        ]);

        Route::get('delete/{category}', [
            'as' => 'sysadmin.category.delete',
            'uses' => 'Sysadmin\CategoryController@delete'
        ]);

    });


});
