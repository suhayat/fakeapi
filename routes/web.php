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

Route::get('/', 'HomeController@index');
Route::group(['prefix' => config('app.admin_page')], function () {
	Auth::routes();
});

Route::group(['prefix' => config('app.admin_page'), 'middleware' => 'auth'], function () {
    Route::get('/', 'AdminController@index');
    Route::get('/profile', 'Auth\ProfileController@index');
    Route::any('/change-password', 'Auth\ProfileController@changePassword');

    Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
	    Route::get('/', 'UsersController@index')->middleware('permission:users_view');
	    Route::get('/{id}/view', 'UsersController@view')->middleware('permission:users_view');
	    Route::any('/create', 'UsersController@create')->middleware('permission:users_create');
	    Route::any('/{id}/edit', 'UsersController@edit')->middleware('permission:users_edit');
	    Route::delete('/{id}/delete', 'UsersController@delete')->middleware('permission:users_delete');
	});

	Route::group(['prefix' => 'roles', 'middleware' => 'auth'], function () {
	    Route::get('/', 'RolesController@index')->middleware('permission:roles_view');
	    Route::get('/{id}/view', 'RolesController@view')->middleware('permission:roles_view');
	    Route::any('/create', 'RolesController@create')->middleware('permission:roles_create');
	    Route::any('/{id}/edit', 'RolesController@edit')->middleware('permission:roles_edit');
	    Route::delete('/{id}/delete', 'RolesController@delete')->middleware('permission:roles_delete');
	});

	Route::group(['prefix' => 'menus', 'middleware' => 'auth'], function () {
	    Route::get('/', 'MenusController@index')->middleware('permission:menus_view');
	    Route::get('/{id}/view', 'MenusController@view')->middleware('permission:menus_view');
	    Route::any('/create', 'MenusController@create')->middleware('permission:menus_create');
	    Route::any('/{id}/edit', 'MenusController@edit')->middleware('permission:menus_edit');
	    Route::delete('/{id}/delete', 'MenusController@delete')->middleware('permission:menus_delete');
	});

	Route::group(['prefix' => 'permissions', 'middleware' => 'auth'], function () {
	    Route::any('/', 'PermissionsController@index')->middleware('permission:permissions_view');
	    Route::get('/{id}/view', 'PermissionsController@view')->middleware('permission:permissions_view');
	    Route::any('/create', 'PermissionsController@create')->middleware('permission:permissions_create');
	    Route::any('/{id}/edit', 'PermissionsController@edit')->middleware('permission:permissions_edit');
	    Route::delete('/{id}/delete', 'PermissionsController@delete')->middleware('permission:permissions_delete');
	});

	Route::group(['prefix' => 'articles', 'middleware' => 'auth'], function () {
	    Route::get('/', 'ArticlesController@index')->middleware('permission:articles_view');
	    Route::get('/{id}/view', 'ArticlesController@view')->middleware('permission:articles_view');
	    Route::any('/create', 'ArticlesController@create')->middleware('permission:articles_create');
	    Route::any('/{id}/edit', 'ArticlesController@edit')->middleware('permission:articles_edit');
	    Route::delete('/{id}/delete', 'ArticlesController@delete')->middleware('permission:articles_delete');
	});

	Route::group(['prefix' => 'sites', 'middleware' => 'auth'], function () {
	    Route::get('/', 'SitesController@index')->middleware('permission:articles_view');
	    Route::any('/create', 'SitesController@create')->middleware('permission:articles_create');
	    Route::any('/{id}/edit', 'SitesController@edit')->middleware('permission:articles_edit');
	    Route::delete('/{id}/delete', 'SitesController@delete')->middleware('permission:articles_delete');
	});
});
