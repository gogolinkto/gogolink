<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RedirectShortUrlController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('/short-urls', ShortUrlController::class);
});
