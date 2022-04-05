<?php

use App\Http\Controllers\HomeController;
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
// redirect to login page if address is not found
Route::get('/', function () {
	return redirect('/login');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', 'Auth\LoginController@login')->name('login');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');


Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController');
	Route::resource('article', 'App\Http\Controllers\ArticleController');
	Route::resource('category', 'App\Http\Controllers\CategoryController');
	Route::get('deletecategory/{id}', 'App\Http\Controllers\CategoryController@destroy')->name('category.destroy');
	Route::get('deletearticle/{id}', 'App\Http\Controllers\ArticleController@destroy')->name('article.destroy');
	Route::get('deleteuser/{id}', 'App\Http\Controllers\UserController@destroy')->name('user.destroy');

	// Route::get('{slug-category}', ['as' => 'category.list', 'uses' => 'App\Http\Controllers\CategoryController@list']);
	Route::get('/news/{category}', 'App\Http\Controllers\CategoryController@list')->name('category.list');
	Route::get('/news/{category}/{article}', 'App\Http\Controllers\ArticleController@list')->name('news.detail');

	Route::resource('administrator', 'App\Http\Controllers\AdministratorController');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

});

