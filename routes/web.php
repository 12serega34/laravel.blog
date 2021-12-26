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

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/article/{slug}', 'App\Http\Controllers\HomeController@show')->name('article.single');
Route::get('/tag/{slug}', 'App\Http\Controllers\TagController@show')->name('tag.single');
Route::get('/category/{slug}', 'App\Http\Controllers\CategoryController@show')->name('category.single');
Route::get('/blog', 'App\Http\Controllers\HomeController@blog')->name('blog.single');
Route::get('/contact', 'App\Http\Controllers\HomeController@contact')->name('contact');
Route::get('/search', 'App\Http\Controllers\SearchController@index')->name('search');
Route::resource('/comments', 'App\Http\Controllers\CommentController');
Route::post('/subscribe', 'App\Http\Controllers\SubscribeController@store')->name('subscribe');


Route::get('/welcome', function(){
    return view('welcome');
})->name('welcome');

Route::group(['middleware'=> 'admin', 'prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin'], function(){
    Route::get('/', 'MainController@index')->name('admin.index');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/tags', 'TagController');
    Route::resource('/posts', 'PostController');
    Route::resource('/comments', 'CommentController');
    Route::get('/deleteImage', 'PostController@deleteImage')->name('deleteImage');
});


Route::group(['middleware' => 'guest', 'namespace' => 'App\Http\Controllers'], function(){
    Route::get('/register', 'UserController@create')->name('register.create');
    Route::post('/register', 'UserController@store')->name('register.store');

    Route::get('/login', 'UserController@loginForm')->name('login.form');
    Route::post('/login', 'UserController@login')->name('login');
});

Route::get('/logout', 'App\Http\Controllers\UserController@logout')->name('logout')->middleware('auth');

