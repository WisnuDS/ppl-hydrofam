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
    Route::resource('user-management', 'App\Http\Controllers\Super\UserManagementController');
    Route::post('user-management/update-role/{id}', 'App\Http\Controllers\Super\UserManagementController@updateRole')->name('update.role');
    Route::view('/create-blog','field_blog');
    Route::get('/edit-blog/{id}','\App\Http\Controllers\User\BlogController@editBlog');
    Route::post('/update-blog/{id}','\App\Http\Controllers\User\BlogController@updateBlog');
    Route::post('/create-new-blog','\App\Http\Controllers\User\BlogController@createNewBlog');
});

//route admin
Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/home','App\Http\Controllers\Admin\HomeController@index');
//    Route::get('/home','App\Http\Controllers\Admin\HomeController@index');
    Route::view('/create-blog','field_blog');
    Route::post('/create-new-blog','\App\Http\Controllers\User\BlogController@createNewBlog');
    Route::get('/edit-blog/{id}','\App\Http\Controllers\User\BlogController@editBlog');
    Route::post('/update-blog/{id}','\App\Http\Controllers\User\BlogController@updateBlog');
    Route::resource('profile', 'App\Http\Controllers\ProfileController')->only(['index','create','update']);
});

//route user
Route::group(['middleware' => ['role:user','activity'], 'prefix' => 'user', 'as' => 'user.'], function() {
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

        Route::get('comment/{post_id}', [\App\Http\Controllers\User\BlogController::class, 'getComments']);
        Route::get('auth', [\App\Http\Controllers\User\BlogController::class, 'getAuth']);
        Route::post('create-comment', [\App\Http\Controllers\User\BlogController::class, 'createComment']);
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
