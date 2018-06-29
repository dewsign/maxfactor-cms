<?php

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::domain('auth' . config('session.domain'))->middleware('cors')->group(function () {
    // Login / Logout
    Route::get('/', 'AuthController@showLoginForm')->name('login');
    Route::post('login', 'AuthController@login')->name('login.submit');
    Route::any('logout', 'AuthController@logout')->name('logout');

    Route::name('password.')
        ->prefix('password')
        ->middleware('auth:api')
        ->group(function () {
            // Forgot Password
            Route::get('reset', 'ForgotPasswordController@showLinkRequestForm')->name('request');
            Route::post('email', 'ForgotPasswordController@sendResetLinkEmail')->name('email');

            // Password Reset
            Route::get('reset/{token}', 'ResetPasswordController@showResetForm');
            Route::post('reset', 'ResetPasswordController@reset')->name('reset');
        });
});
