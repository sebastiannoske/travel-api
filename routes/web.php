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
Route::get('/events/{event_id}/travel', 'PagesController@showTravel');
Route::get('/edit-travel/{travel}', 'PagesController@editTravel');
Route::post('/travel/{travel}/ispublic', 'TravelController@setPublicValue');
Route::post('/travel/{travel}/isverified', 'TravelController@setVerifiedValue');
Route::post('/travel/{travel}/stopover', 'TravelController@storeStopover');
Route::post('/travel/{travel}/stopover/{stopover_id}/destroy', 'TravelController@destroyStopover');
Route::post('/travel/{travel}/update', 'TravelController@update');
Route::post('/travel/{travel}/destroy', 'TravelController@destroy');
Route::get('/register/confirm/{token}', 'Auth\RegisterController@confirmEmail');
Route::get('/travel/confirm/{token}', 'TravelController@confirmTravel');
Route::get('/travel/{url_token}', 'PagesController@showByUrlToken');
Route::get('/exportcsv', 'TravelController@generateCsv');
Route::get('/exportxls', 'TravelController@generateXls');

Route::get('/events', 'EventController@editEvents');
Route::get('/events/{event_id}/edit', 'EventController@editEvent');
Route::post('/events/{event_id}/update', 'EventController@update');
Route::post('/events/create', 'EventController@create');
Route::post('/events/{event_id}/hasuser/{user_id}', 'EventController@setHasUserValue');

Route::post('/fileUpload/{event_id}', ['as'=>'fileUpload','uses'=>'PagesController@fileUpload']);
Route::post('/events/{event_id}/destinations', 'DestinationController@storeDestination');
Route::post('/events/{event_id}/destinations/{destination_id}/update', 'DestinationController@update');
Route::post('/events/{event_id}/destinations/{destination_id}/delete', 'DestinationController@destroy');
Route::get('/events/{event_id}/destinations/{destination_id}', 'DestinationController@editDestination');


Route::get('/user', 'PagesController@editUser');
Route::post('/events/{event_id}/user/create', 'UserController@create');
Route::post('/user/{user}/update', 'UserController@update');
Route::post('/user/{user}/updatepassword', 'UserController@updatePassword');

Route::get('/emails', 'PagesController@editEmails');
Route::post('/email/{email}/update', 'EmailController@update');

Route::get('/users', 'PagesController@editAllUser');
Route::get('/users/edit/{user}', 'PagesController@editUserById');
Route::get('/users/create', 'PagesController@createUser');
Route::post('/users/{user}/destroy', 'UserController@destroy');
Route::post('/users/{user}/apikey', 'UserController@generateApikey');