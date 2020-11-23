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

Route::group(['api'],function () {
    Route::post('/login', 'Auth\LoginController@login');
    Route::post('trip/calculate', 'HomeController@calculate');
    Route::post('trip/save', 'HomeController@saveTrip');
    Route::get('cities', 'HomeController@getCities');
    Route::get('user/{id}/trips', 'HomeController@getTrips');
});

