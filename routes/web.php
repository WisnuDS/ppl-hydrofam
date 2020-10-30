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

//route admin
Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/home','App\Http\Controllers\Admin\HomeController@index');
});

//route user
Route::group(['middleware' => 'role:user', 'prefix' => 'user', 'as' => 'user.'], function() {
    Route::get('/home','App\Http\Controllers\User\HomeController@index');
    Route::resource('profile', 'App\Http\Controllers\ProfileController')->only(['index','create','update']);
});

Route::prefix('blog')->group(function (){
    Route::prefix('api')->group(function () {
        Route::get('posts', [\App\Http\Controllers\CanvasUiController::class, 'getPosts']);
        Route::get('posts/{slug}', [\App\Http\Controllers\CanvasUiController::class, 'showPost'])
            ->middleware('Canvas\Http\Middleware\Session');

        Route::get('tags', [\App\Http\Controllers\CanvasUiController::class, 'getTags']);
        Route::get('tags/{slug}', [\App\Http\Controllers\CanvasUiController::class, 'showTag']);
        Route::get('tags/{slug}/posts', [\App\Http\Controllers\CanvasUiController::class, 'getPostsForTag']);

        Route::get('topics', [\App\Http\Controllers\CanvasUiController::class, 'getTopics']);
        Route::get('topics/{slug}', [\App\Http\Controllers\CanvasUiController::class, 'showTopic']);
        Route::get('topics/{slug}/posts', [\App\Http\Controllers\CanvasUiController::class, 'getPostsForTopic']);

        Route::get('users/{id}', [\App\Http\Controllers\CanvasUiController::class, 'showUser']);
        Route::get('users/{id}/posts', [\App\Http\Controllers\CanvasUiController::class, 'getPostsForUser']);
    });

    Route::get('/', [\App\Http\Controllers\User\BlogController::class, 'index']);
    Route::get('/{view}', [\App\Http\Controllers\User\BlogController::class, 'singlePost']);
});

//Route::prefix('canvas-ui')->group(function () {
//
//
//    Route::get('/{view?}', [\App\Http\Controllers\CanvasUiController::class, 'index'])
//         ->where('view', '(.*)')
//         ->name('canvas-ui');
//});
