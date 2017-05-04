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

Auth::routes();
Route::any('/register', function() {
    return redirect('/');
});

Route::get('/', 'PagesController@index');
Route::get('/travel/{travel}', 'PagesController@edit');
Route::post('/travel/{travel}/ispublic', 'TravelController@setPublicValue');
Route::post('/travel/{travel}/update', 'TravelController@update');
Route::post('/travel/{travel}/destroy', 'TravelController@destroy');
Route::get('/register/confirm/{token}', 'Auth\RegisterController@confirmEmail');
Route::get('/travel/confirm/{token}', 'TravelController@confirmTravel');
Route::get('/fahrt/{url_token}', 'PagesController@showByUrlToken');