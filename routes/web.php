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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api/v1', 'middleware' => 'auth:api'], function() {



});
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/travel', 'PagesController@index');
Route::get('/travel/{travel}', 'PagesController@edit');
Route::get('/register/confirm/{token}', 'Auth\RegisterController@confirmEmail');
