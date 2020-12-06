<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'painel'], function() {
	//PostController
	Route::get('posts', 'Painel\PostController@index');

	//PermissionController
	Route::get('permissions', 'Painel\PermissionController@index');
	Route::get('permission/{id}/roles', 'Painel\PermissionController@roles');

	//RoleController
	Route::get('roles', 'Painel\RoleController@index');
	Route::get('role/{id}/permissions', 'Painel\RoleController@permissions');

	//UserController
	Route::get('users', 'Painel\UserController@index');
	Route::get('user/{id}/roles', 'Painel\UserController@roles');

	//Painel Controller
	Route::get('/', 'Painel\PainelController@index');

});



Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post/{id}/update', 'HomeController@update');

Route::get('/roles-permissions', 'HomeController@rolesPermissions'); //Rota de Debug

Auth::routes();

Route::get('/', 'Portal\SiteController@index');
