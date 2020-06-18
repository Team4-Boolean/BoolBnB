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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')
->namespace('Admin')
->name('admin.')
->middleware('auth')
->group(function ()
{
    Route::resource('houses', 'HouseController');
    Route::resource('photos', 'PhotoController');
    Route::resource('messages', 'MessageController');
});

Route::resource('houses', 'HouseController');

//Save message
Route::post('messages', 'MessageController@store')->name('save_message');
