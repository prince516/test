<?php

use Illuminate\Http\Request;

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


Route::post('register', 'Api\AccountController@register');
Route::post('update', 'Api\AccountController@update');
Route::delete('delete/{id}', 'Api\AccountController@destroy');
Route::get('info/{id}', 'Api\AccountController@info');
Route::get('all/{id}', 'Api\AccountController@all');

Route::post('card_insert', 'Api\CardController@store');
Route::post('card_update/{id}', 'Api\CardController@update');
Route::delete('card_delete/{id}', 'Api\CardController@destroy');
Route::get('card_info/{id}', 'Api\CardController@info');

Route::post('vehicle_insert', 'Api\VehicleController@store');
Route::post('vehicle_update/{id}', 'Api\VehicleController@update');
Route::get('vehicle_info/{id}', 'Api\VehicleController@info');
