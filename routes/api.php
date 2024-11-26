<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;

Route::apiResource('/user', UserController::class);

Route::apiResource('/image', ImageController::class);