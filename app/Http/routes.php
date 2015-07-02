<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('home', 'HomeController@index');


/* Zones */
Route::get('zones', 'ZoneController@index');

Route::get('zones/create', 'ZoneController@create');
Route::post('zones/create', 'ZoneController@add');

Route::get('zones/view/{id}', 'ZoneController@viewZone')->where('id', '[0-9]+');
Route::post('zones/view/{id}', 'ZoneController@updateZone')->where('id', '[0-9]+');


/* Watering Lengths */
Route::get('lengths', 'LengthsController@index');

Route::get('lengths/create', 'LengthsController@create');
Route::post('lengths/create', 'LengthsController@add');

Route::get('lengths/view/{id}', 'LengthsController@viewLength')->where('id', '[0-9]+');
Route::post('lengths/view/{id}', 'LengthsController@updateLength')->where('id', '[0-9]+');