<?php

use Illuminate\Support\Facades\Route;

$namespace = 'App\Http\Controllers';
Route::prefix('api/bookings')->middleware('web')->namespace($namespace)->group(base_path('routes/api/bookings.php'));
