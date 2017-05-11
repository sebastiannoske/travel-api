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
Route::get('/edit-travel/{travel}', 'PagesController@editTravel');
Route::post('/travel/{travel}/ispublic', 'TravelController@setPublicValue');
Route::post('/travel/{travel}/stopover', 'TravelController@storeStopover');
Route::post('/travel/{travel}/update', 'TravelController@update');
Route::post('/travel/{travel}/destroy', 'TravelController@destroy');
Route::get('/register/confirm/{token}', 'Auth\RegisterController@confirmEmail');
Route::get('/travel/confirm/{token}', 'TravelController@confirmTravel');
Route::get('/travel/{url_token}', 'PagesController@showByUrlToken');

Route::get('/user', 'PagesController@editUser');
Route::post('/user/{user}/update', 'UserController@update');
Route::post('/user/{user}/updatepassword', 'UserController@updatePassword');

Route::get('/emails', 'PagesController@editEmails');
Route::post('/email/{email}/update', 'EmailController@update');

Route::get('/emails', 'PagesController@editEmails');

Route::get('/users', 'PagesController@editAllUser');
Route::get('/users/{user}', 'PagesController@editUserById');
Route::post('/users/{user}/destroy', 'UserController@destroy');
Route::post('/users/{user}/apikey', 'UserController@generateApikey');