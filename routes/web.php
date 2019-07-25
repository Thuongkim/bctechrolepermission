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

// Route::get('/', function () {
//     return view('welcome');
// });
// Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm')->name('showLoginForm');

Route::post('login', 'Auth\LoginController@login')->name('login');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index');

// Route::group(['middleware' => ['role:administrator']], function () {
// Route::resource('users', 'UsersController');
// Route::resource('permissions', 'PermissionController');
// Route::resource('roles', 'RolesController');
// });
// Dashboard
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
 
Route::group(array('middleware' => 'admin'), function() {
	Route::resource('users', 'UserController');
	Route::resource('permissions', 'PermissionController');
	Route::resource('roles', 'RoleController');
});