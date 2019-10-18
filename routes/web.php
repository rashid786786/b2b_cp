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

Route::get('/', function () {
    return view('home');
});

Route::post('/register', 'AuthController@register');

Route::post('/login', 'AuthController@login');

Route::post('/forgot_password', 'AuthController@forgotPassword');

Route::post('/check_if_email_already_exist', 'AuthController@checkIfEmailAlreadyExist');

Route::get('/user/verify_email/{token}', 'AuthController@verifyUser');

Route::get('/user/reset_password/{token}', 'AuthController@resetPassword');