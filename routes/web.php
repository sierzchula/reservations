<?php

use Illuminate\Support\Facades\Route;

//Route::get('/',function(){returnview('welcome');});

Auth::routes(['reset' => false, 'register' => false]);
Route::redirect('/home','/reservations');

//Route::get('/home','HomeController@index')->name('home');

Route::group(["middleware"=>"auth"], function(){
    Route::redirect('/','/reservations');

    Route::get('/reservations','ReservationsController@index')->name('reservations.index');
    Route::get('/reservations/create/{apartment}','ReservationsController@create')->name('reservations.create');
    Route::post('/reservations','ReservationsController@store')->name('reservations.store');
    Route::get('/reservations/date/{year}/{month}','ReservationsController@index')->name('reservations.indexdate');
    Route::get('/reservations/{reservation}','ReservationsController@show')->name('reservations.show');
    Route::get('/reservations/{reservation}/edit','ReservationsController@edit')->name('reservations.edit');
    Route::put('/reservations/{reservation}','ReservationsController@update')->name('reservations.update');
    Route::delete('/reservations/{reservation}','ReservationsController@destroy')->name('reservations.destroy');

    Route::get('/apartments','ApartmentsController@index')->name('apartments.index');
    Route::get('/apartments/create','ApartmentsController@create')->name('apartments.create');
    Route::post('/apartments','ApartmentsController@store')->name('apartments.store');
    Route::get('/apartments/{apartment}','ApartmentsController@show')->name('apartments.show');
    Route::get('/apartments/{apartment}/edit','ApartmentsController@edit')->name('apartments.edit');
    Route::put('/apartments/{apartment}','ApartmentsController@update')->name('apartments.update');
    Route::delete('/apartments/{apartment}','ApartmentsController@destroy')->name('apartments.destroy');

    Route::get('/clients','ClientsController@index')->name('clients.index');
    Route::get('/clients/create','ClientsController@create')->name('clients.create');
    Route::post('/clients','ClientsController@store')->name('clients.store');
    Route::get('/clients/{client}','ClientsController@show')->name('clients.show');
    Route::get('/clients/{client}/edit','ClientsController@edit')->name('clients.edit');
    Route::put('/clients/{client}','ClientsController@update')->name('clients.update');
    Route::delete('/clients/{client}','ClientsController@destroy')->name('clients.destroy');

    Route::get('/statistics','StatisticsController@index')->name('statistics.index');
    Route::post('/statistics','StatisticsController@index')->name('statistics.index');

    Route::get('/backup','BackupController@index')->name('backup.index');
});
