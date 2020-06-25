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

Route::middleware('api.auth')->get('/houses', 'Api\HouseController@getAll');

// Route::middleware('api.auth')->get('houses/{id}', 'Api\HouseController@getHouse');
Route::middleware('api.auth')->get('/houses/{lat}/{log}', 'Api\HouseController@getHouse');
