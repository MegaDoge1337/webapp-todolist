<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'App\Http\Controllers\API\AuthController@register')->name('auth.register');
Route::post('/login', 'App\Http\Controllers\API\AuthController@login')->name('auth.login');
Route::middleware('auth:api')->post('/logout', 'App\Http\Controllers\API\AuthController@logout')->name('auth.logout');

Route::middleware('auth:api')->get('/todolist', 'App\Http\Controllers\API\TodoListController@getByUserId')->name('todolist.get');
Route::middleware('auth:api')->post('/todolist', 'App\Http\Controllers\API\TodoListController@create')->name('todolist.post');
Route::middleware('auth:api')->patch('/todolist/{id}', 'App\Http\Controllers\API\TodoListController@markComplete')->name('todolist.patch');
Route::middleware('auth:api')->delete('/todolist/{id}','App\Http\Controllers\API\TodoListController@delete')->name('todolist.delete');
