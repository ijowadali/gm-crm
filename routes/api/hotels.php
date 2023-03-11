<?php

use Illuminate\Support\Facades\Route;


Route::namespace('Api')->group(function () {
    Route::group(['middleware' => 'auth:sanctum', 'namespace' => 'Hotels'], function () {
        Route::get('/', 'HotelsController@index');
//        Route::put('/{id}', 'AreasController@update');
        Route::get('/{id}', 'HotelsController@getHotelData');
        Route::post('/', 'HotelsController@create');
        Route::delete('/{id}', 'HotelsController@delete');
//        Route::put('/{id}/status', 'AreasController@updateStatus');
    });
});
