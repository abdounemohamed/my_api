<?php

use App\Http\Controllers\Api\V1\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',  HomeController::class);

Route::post('/key/post',  [HomeController::class, 'post']);

Route::get('/key/{key}/{timestamp?}', [HomeController::class, 'get']);

Route::get('/keys', [HomeController::class, 'all']);
