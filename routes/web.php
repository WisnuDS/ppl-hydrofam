<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//route SuperAdmin
Route::group(['middleware' => 'role:super', 'prefix' => 'super', 'as' => 'super.'], function() {
    Route::get('/home','App\Http\Controllers\Super\HomeController@index');
});

Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/home','App\Http\Controllers\Admin\HomeController@index');
});

Route::group(['middleware' => 'role:user', 'prefix' => 'user', 'as' => 'user.'], function() {
    Route::get('/home','App\Http\Controllers\User\HomeController@index');
});
