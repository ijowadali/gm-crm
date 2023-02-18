<?php

use Illuminate\Support\Facades\Route;


Route::namespace('Api')->group(function () {
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/', 'BookingsController@index');
        Route::get('/search', 'AreasController@search');
        Route::put('/{id}', 'AreasController@update');
        Route::post('/', 'AreasController@create');
        Route::delete('/{id}', 'AreasController@delete');
        Route::put('/{id}/status', 'AreasController@updateStatus');
    });
});
