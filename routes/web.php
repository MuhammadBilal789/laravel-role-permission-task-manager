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
Route::redirect('/', '/login');

Auth::routes();
Route::group(['middleware' => ['auth', 'role:user'], 'prefix' => 'user', 'as' => 'user.'], function () {

    Route::get('/dashboard', 'User\DashboardController@index');
    Route::get('/tasks/search', 'User\TaskController@search')->name('tasks.search');
    Route::resource('tasks', 'User\TaskController');

});

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/dashboard', 'Admin\DashboardController@index');
    Route::get('/tasks/search', 'Admin\TaskController@search')->name('tasks.search');
    Route::resource('permissions', 'Admin\PermissionController');
    Route::resource('tasks', 'Admin\TaskController');

});
