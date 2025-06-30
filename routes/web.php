<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;

Route::get('/', [LinkController::class, 'index'])->name('home');
Route::post('/', [LinkController::class, 'store'])->name('links.store');
Route::get('/{short_code}', [LinkController::class, 'redirect'])->name('links.redirect');