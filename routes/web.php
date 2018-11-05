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

Route::get('/', 'PublicController@index')->name('index');
Route::get('post/{id}', 'PublicController@singlePost')->name('singlePost');
Route::get('about', 'PublicController@about')->name('about');
Route::get('contact', 'PublicController@contact')->name('contact');
Route::post('contact', 'PublicController@contactPost')->name('contactPost');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::prefix('user')->group(function () {
    Route::post('new-comment', 'UserController@newComment')->name('newComment');
   Route::get('dashboard', 'UserController@dashboard')->name('userDashboard');
   Route::get('comments', 'UserController@comments')->name('userComments');
   Route::post('comments/{id}/delete', 'UserController@delete')->name('userCommentDelete');
   Route::get('profile', 'UserController@profile')->name('userProfile');
   Route::post('profile', 'UserController@profilePost')->name('userProfilePost');
});

Route::prefix('author')->group(function () {
    Route::get('dashboard', 'AuthorController@dashboard')->name('authorDashboard');
    Route::get('posts', 'AuthorController@posts')->name('authorPosts');
    Route::get('posts/new', 'AuthorController@postsNew')->name('authorPostsNew');
    Route::get('posts/{id}/edit', 'AuthorController@postsEdit')->name('authorPostEdit');
    Route::post('posts/{id}/edit', 'AuthorController@postsEditPost')->name('authorPostEditPost');
    Route::post('posts/{id}/delete', 'AuthorController@deletePost')->name('deletePost');
    Route::post('posts/new', 'AuthorController@createPost')->name('authorPostsCreate');
    Route::get('comments', 'AuthorController@comments')->name('authorComments');
});

Route::prefix('admin')->group(function () {
    Route::get('dashboard', 'AdminController@dashboard')->name('adminDashboard');
    Route::get('users', 'AdminController@users')->name('adminUsers');
    Route::get('posts', 'AdminController@posts')->name('adminPosts');
    Route::get('comments', 'AdminController@comments')->name('adminComments');
    Route::get('posts/{id}/edit', 'AdminController@postsEdit')->name('adminPostEdit');
    Route::post('posts/{id}/edit', 'AdminController@postsEditPost')->name('adminPostEditPost');
    Route::post('posts/{id}/delete', 'AdminController@deletePost')->name('adminDeletePost');
    Route::post('comments/{id}/delete', 'AdminController@deleteComments')->name('adminDeleteComments');
    Route::get('user/{id}/edit', 'AdminController@usersEdit')->name('adminUserEdit');
    Route::post('user/{id}/edit', 'AdminController@usersEditPost')->name('adminUserEditPost');
    Route::post('user/{id}/delete', 'AdminController@userDelete')->name('adminDeleteUser');

    Route::get('products', 'AdminController@products')->name('adminProducts');
    Route::get('products/new', 'AdminController@newProduct')->name('adminNewProducts');
    Route::post('products/new', 'AdminController@newProductPost')->name('adminNewProductsPost');
    Route::get('product/{id}', 'AdminController@editProduct')->name('adminEditProducts');
    Route::post('product/{id}', 'AdminController@editProductPost')->name('adminEditProductsPost');
    Route::post('product/{id}/delete', 'AdminController@editProductDelete')->name('adminEditProductsDelete');

});

Route::prefix('shop')->group(function () {
   Route::get('/', 'ShopController@index')->name('shop.index');
   Route::get('product/{id}', 'ShopController@singleProduct')->name('shop.singleProduct');
   Route::get('product/{id}/order', 'ShopController@orderProduct')->name('shop.orderProduct');
});