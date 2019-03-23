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

Route::get('/', 'BlogController@index')->middleware('web');

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('{slug}', [
	'as' => 'blog.single',
	'uses' => 'BlogController@getSingle'
])->where(
	'slug', '[\w\d\-\_]+'
);

Route::get('{image_slug}', [
	'as' => 'blog.image',
	'uses' => 'BlogController@getImage'
])->where(
	'slug', '[\w\d\-\_]+'
);

Route::prefix('manage')->middleware('role:superadministrator|administrator|editor|author|contributor')->group(function ()
{
	Route::get('/', 'ManageController@index');
	Route::get('/dashboard', 'ManageController@dashboard')->name('manage.dashboard');
	Route::resource('/users', 'UserController');
	Route::resource('/notifications', 'NotificationController');
	Route::resource('/posts', 'PostsController');
	Route::resource('/products', 'ProductController');
	Route::resource('/screenshots', 'ScreenshotController');
});