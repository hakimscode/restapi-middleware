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

Route::get('/', function(){
    return 'Rest API with Middleware';
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');
});

Route::group(['prefix' => 'profile'], function () {
    Route::get('/', 'ProfileController@index')->middleware('auth:api');
    Route::put('/{id}', 'ProfileController@update')->middleware('auth:api', 'own');
});