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
    Route::resource('promotions', 'PromotionController');
    Route::post('/promotions/checkout', 'CheckoutController@store')->name('checkout.store');
    Route::get('/promotions/checkout', 'CheckoutController@index')->name('checkout.index');

});

Route::get('/houses/search', 'SearchController@index')->name('search.index');


Route::resource('houses', 'HouseController');



//Save message
Route::post('messages', 'MessageController@store')->name('save_message');
