<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get(
    '/',
    [HomeController::class, 'index']
)->name('home');

Route::post(
    '/ballot',
    [HomeController::class, 'submit']
)->name('ballot');
