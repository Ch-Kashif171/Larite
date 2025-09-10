<?php

use App\Http\Controllers\HomeController;
use Lumite\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
