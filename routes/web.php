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
    return view('welcome');
});

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// 全ユーザーはログインとログアウト、パスワードの変更ができる
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('password/confirm ', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

// 管理者と開発者のみ許可のルート
Route::middleware(['auth', 'can:system-higher'])->group(function () {
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
    Route::get('admin/index', 'AdminController@index')->name('admin.index');
    Route::get('admin/restore/{id}', 'AdminController@restore')->name('admin.restore');
});

Route::resource('posts', 'PostController');

/* Route::get('users', 'UserController@index');
Route::get('users/{id}', 'UserController@show');
Route::delete('users/{id}', 'UserController@destroy'); */
Route::resource('users', 'UserController');

Route::resource('comments', 'CommentController', ['only' => ['store']]);

