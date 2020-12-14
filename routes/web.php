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
    Route::resource('/shop','App\Http\Controllers\ShopController')->except('index','show');
    Route::get('transaction','App\Http\Controllers\TransactionController@index');
    Route::get('transaction/{id}','App\Http\Controllers\TransactionController@show');
    Route::post('transaction/{id}/confirm','App\Http\Controllers\TransactionController@confirm');
});

//route admin
Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/home','App\Http\Controllers\Admin\HomeController@index');
    Route::view('/create-blog','field_blog');
    Route::post('/create-new-blog','\App\Http\Controllers\User\BlogController@createNewBlog');
    Route::get('/edit-blog/{id}','\App\Http\Controllers\User\BlogController@editBlog');
    Route::post('/update-blog/{id}','\App\Http\Controllers\User\BlogController@updateBlog');
    Route::resource('profile', 'App\Http\Controllers\ProfileController')->only(['index','create','update']);
    Route::resource('/shop','App\Http\Controllers\ShopController')->except('index','show');
    Route::get('transaction','App\Http\Controllers\TransactionController@index');
    Route::get('transaction/{id}','App\Http\Controllers\TransactionController@show');
    Route::post('transaction/{id}/confirm','App\Http\Controllers\TransactionController@confirm');
});

//route user
Route::group(['middleware' => ['role:user','activity'], 'prefix' => 'user', 'as' => 'user.'], function() {
    Route::get('/home','App\Http\Controllers\User\HomeController@index');
    Route::resource('profile', 'App\Http\Controllers\ProfileController')->only(['index','create','update']);
    Route::resource('/cart', 'App\Http\Controllers\CartController')->only(['index']);
    Route::post('/checkout','App\Http\Controllers\CartController@checkout');
    Route::get('/history/checkout/{id}',[App\Http\Controllers\CartController::class,'detailCheckout']);
    Route::post('/upload/proof',[\App\Http\Controllers\CartController::class,'updateImageTransaction']);
});

//Canvas API Route
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

//Blog Route For Guest
Route::resource('/shop','App\Http\Controllers\ShopController')->only(['index','show']);

//Api Route
Route::group(["prefix"=>"api"], function (){
    Route::get('/product/{id}',[\App\Http\Controllers\ShopController::class,'getSingleProduct']);
    Route::group(["middleware" => ["role:user"]],function (){
        Route::group(["prefix"=>"cart"],function (){
            Route::post('add',[\App\Http\Controllers\ShopController::class,'addToCart']);
            Route::post('update/{id}',[\App\Http\Controllers\CartController::class,'updateCart']);
            Route::delete('delete/{id}',[\App\Http\Controllers\CartController::class,'deleteCart']);
            Route::get('all',[\App\Http\Controllers\ShopController::class,'getAllCart']);
        });
        Route::get('/address',[\App\Http\Controllers\CartController::class,'address']);
    });
});

//Route::prefix('canvas-ui')->group(function () {
//
//
//    Route::get('/{view?}', [\App\Http\Controllers\CanvasUiController::class, 'index'])
//         ->where('view', '(.*)')
//         ->name('canvas-ui');
//});

// FRONTEND VIEW ROUTE
//Route::view('/products','products');
//Route::view('/products/id-product','products_details');
//Route::view('admin/products/new','field_product');
//Route::view('super/products/new','field_product');
//Route::view('admin/products/id-product/edit','field_product');
//Route::view('super/products/id-product/edit','field_product');
//Route::view('users/cart','cart');
//Route::view('users/checkout','checkout');
//Route::view('admin/transaction','transaction');
//Route::view('super/transaction','transaction');
//Route::view('admin/transaction/id-transaction','transaction_details');
//Route::view('super/transaction/id-transaction','transaction_details');
Route::view('admin/message','message');
Route::view('super/message','message');
// END FRONTEND VIEW ROUTE
