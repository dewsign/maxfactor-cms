<?php

Route::name('admin.')
    ->namespace('Admin')
    ->middleware(['auth', 'can:access_admin'])
    ->domain('admin' . config('session.domain'))
    ->prefix('{locale?}')
    ->group(function () {
        // Dashboard
        Route::get('/', 'AdminController@index')->name('index');

        // Users
        Route::name('user.')
            ->prefix('user')
            ->middleware(['auth', 'can:access_admin_users'])
            ->group(function () {
                Route::get('/', 'UserController@index')->name('index');
                Route::get('current', 'UserController@current')->name('current');
                Route::get('create', 'UserController@create')->name('create');
                Route::post('create', 'UserController@store')->name('store');
                Route::get('{user}', 'UserController@show')->name('show');
                Route::post('{user}', 'UserController@update')->name('update');
                Route::delete('{user}', 'UserController@destroy')->name('destroy');
            });

        // Roles
        Route::name('role.')
            ->prefix('role')
            ->middleware(['auth', 'can:access_admin_roles'])
            ->group(function () {
                Route::get('/', 'RoleController@index')->name('index');
                Route::get('permissions', 'RoleController@permissions')->name('permissions');
                Route::get('create', 'RoleController@create')->name('create');
                Route::post('create', 'RoleController@store')->name('store');
                Route::get('{role}', 'RoleController@show')->name('show');
                Route::post('{role}', 'RoleController@update')->name('update');
                Route::delete('{role}', 'RoleController@destroy')->name('destroy');
            });

        // Languages
        Route::name('language.')
            ->prefix('language')
            ->middleware(['auth', 'can:access_admin_languages'])
            ->group(function () {
                Route::get('/', 'LanguageController@index')->name('index');
                Route::get('permissions', 'LanguageController@permissions')->name('permissions');
                Route::get('create', 'LanguageController@create')->name('create');
                Route::post('create', 'LanguageController@store')->name('store');
                Route::get('{language}', 'LanguageController@show')->name('show');
                Route::post('{language}', 'LanguageController@update')->name('update');
                Route::delete('{language}', 'LanguageController@destroy')->name('destroy');
            });

        // Image
        Route::group(['prefix' => 'images', 'as' => 'image.'], function () {
            Route::get('{options}/{image_id}.{image_ext}', 'ImageController@show')->name('show');
            Route::post('create', 'ImageController@store')->name('create');
            Route::delete('{image_id}', 'ImageController@destroy')->name('delete');
        });
    });
