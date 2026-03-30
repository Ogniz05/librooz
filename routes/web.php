<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LibroController;

Route::get('/', function () { return view('loading'); })->name('loading');

Route::get('/home', [LibroController::class, 'index'])->name('home');

Route::get('/catalogo', function () { return view('welcome'); })->name('catalogo');
Route::get('/carrello', function () { return view('welcome'); })->name('carrello.index');

Route::middleware('auth')->group(function () {
    Route::get('/profilo', function () { return view('profile.index'); })->name('profile.index');
    Route::get('/ordini', function () { return view('orders.index'); })->name('orders.index');
});

require __DIR__.'/auth.php';