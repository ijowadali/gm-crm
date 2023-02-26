<?php

use Illuminate\Support\Facades\Route;


Route::namespace('Api')->group(function () {
    Route::group(['middleware' => 'auth:sanctum', 'namespace' => 'Bookings'], function () {
        Route::get('/', 'BookingsController@index');
//        Route::put('/{id}', 'AreasController@update');
        Route::get('/{id}', 'BookingsController@getBookingData');
        Route::post('/', 'BookingsController@create');
//        Route::delete('/{id}', 'AreasController@delete');
//        Route::put('/{id}/status', 'AreasController@updateStatus');
    });
});
