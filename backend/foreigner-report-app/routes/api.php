<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// 会員登録のapi
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register')->name('register');

// ログインのapi
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');

// ログアウトのapi
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/user', function () {
    return Auth::user();
})->name('user');
