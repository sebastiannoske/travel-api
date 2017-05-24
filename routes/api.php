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

Route::group(['middleware' => 'auth:api'], function() {

    Route::resource('events', 'EventController', [
        'only' => [
            'index', 'show'
        ]
    ]);

    Route::resource('transportation_means', 'TransportationMeanController', [
        'only' => [
            'index', 'show'
        ]
    ]);

    Route::resource('events.destinations', 'DestinationController', [
        'only' => [
            'index', 'show'
        ]
    ]);

    Route::resource('destinations.travel', 'TravelController', [
        'only' => [
            'index', 'show', 'store'
        ]
    ]);

    Route::resource('transportation_means', 'TransportationMeanController', [
        'only' => [
            'index', 'show'
        ]
    ]);

    Route::get('destinations/{destination_id}/transportation_means', 'TransportationMeanController@indexByTravelId');


});