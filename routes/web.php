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

//Route::get('/', function () {return view('welcome');});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::redirect('/', '/reservations');

Route::get(     '/reservations',            'ReservationsController@index')->name(  'reservations.index');
Route::get(     '/reservations/create',     'ReservationsController@create')->name( 'reservations.create');
Route::post(    '/reservations',            'ReservationsController@store')->name(  'reservations.store');
Route::get(     '/reservations/{id}',       'ReservationsController@show')->name(   'reservations.show');
Route::get(     '/reservations/{id}/edit',  'ReservationsController@edit')->name(   'reservations.edit');
Route::put(     '/reservations/{id}',       'ReservationsController@update')->name( 'reservations.update');
Route::delete(  '/reservations/{id}',       'ReservationsController@destroy')->name('reservations.destroy');

Route::get(     '/apartaments',             'ApartamentsController@index')->name(   'apartaments.index');
Route::get(     '/apartaments/create',      'ApartamentsController@create')->name(  'apartaments.create');
Route::post(    '/apartaments',             'ApartamentsController@store')->name(   'apartaments.store');
Route::get(     '/apartaments/{id}',        'ApartamentsController@show')->name(    'apartaments.show');
Route::get(     '/apartaments/{id}/edit',   'ApartamentsController@edit')->name(    'apartaments.edit');
Route::put(     '/apartaments/{id}',        'ApartamentsController@update')->name(  'apartaments.update');
Route::delete(  '/apartaments/{id}',        'ApartamentsController@destroy')->name( 'apartaments.destroy');

Route::get(     '/clients',                 'ClientsController@index')->name(       'clients.index');
Route::get(     '/clients/create',          'ClientsController@create')->name(      'clients.create');
Route::post(    '/clients',                 'ClientsController@store')->name(       'clients.store');
Route::get(     '/clients/{id}',            'ClientsController@show')->name(        'clients.show');
Route::get(     '/clients/{id}/edit',       'ClientsController@edit')->name(        'clients.edit');
Route::put(     '/clients/{id}',            'ClientsController@update')->name(      'clients.update');
Route::delete(  '/clients/{id}',            'ClientsController@destroy')->name(     'clients.destroy');
