<?php

use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Http;
use App\Services\QuotesService;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/quotes', function () {
    // use quotes service class to obtain all quotes and cache them.
    $quotesService = new QuotesService;
    $quotes = $quotesService->getQuotesData(5);
    return view('quotes', ['quotes'=> $quotes]);
})->middleware('auth')->name('quotes');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
