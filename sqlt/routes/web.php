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

Route::get('/', 'homeController@index');
Route::get('/persons', 'peopleController@index');
Route::post('/persons/crud', 'peopleController@crud');
Route::get('/exercises/{id}', 'exercisesController@index');
Route::post('/exercises/answer/{id}', 'exercisesController@correct');
Route::get('/management', 'managementController@index');
