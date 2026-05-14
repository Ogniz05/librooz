<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\CarrelloController;

/*
|--------------------------------------------------------------------------
| Web Routes - Librooz E-commerce
|--------------------------------------------------------------------------
*/

// Home e Catalogo
Route::get('/', function () { return view('loading'); })->name('loading');
Route::get('/home', [LibroController::class, 'index'])->name('home');
Route::get('/catalogo', [LibroController::class, 'catalogo'])->name('catalogo');

// Rotte Carrello (Sia per Ospiti che per Loggati)
Route::get('/carrello', [CarrelloController::class, 'index'])->name('carrello.index');
Route::post('/carrello/aggiungi/{id}', [CarrelloController::class, 'aggiungi'])->name('carrello.add');
Route::delete('/carrello/rimuovi/{id}', [CarrelloController::class, 'rimuovi'])->name('carrello.remove');

// Rotte Protette da Auth
Route::middleware('auth')->group(function () {
    Route::get('/profilo', function () { return view('profile.index'); })->name('profile.index');
    Route::get('/ordini', function () { return view('orders.index'); })->name('orders.index');
    
    // Rotta per la creazione dell'ordine (Checkout)
    // Route::post('/ordine/conferma', [OrdineController::class, 'store'])->name('ordine.store');
});

require __DIR__.'/auth.php';