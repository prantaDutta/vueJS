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
    return view('public.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Category
Route::post('/add-category','CategoryController@addCategory');
Route::get('category','CategoryController@allCategory');
Route::get('deleteCategory/{id}','CategoryController@deleteCategory');
Route::get('toEditCategory/{id}','CategoryController@toEditCategory');
Route::post('updateCategory/{id}','CategoryController@updateCategory');
Route::get('deleteSelectedCategory/{id}','CategoryController@deleteSelectedCategory');
//Post
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('post','PostController@allPost');
    Route::get('users','HomeController@allUsers');
    Route::post('savePost','PostController@savePost');
    Route::get('toEditPost/{id}','PostController@toEditPost');
    Route::post('updatePost/{id}','PostController@updatePost');
    Route::get('deletePost/{id}','PostController@deletePost');
});
//Blog Routers
Route::get('blogPost','BlogController@getAllBlogPost');
Route::get('singlePost/{id}','BlogController@singlePost');
Route::get('categories','BlogController@categories');
Route::get('categoryPost/{id}','BlogController@categoryPost');
Route::get('search','BlogController@searchPost');
Route::get('latestPost','BlogController@latestPost');

//Route::get('/{anypath}', 'HomeController@index')->where('path','.*');
