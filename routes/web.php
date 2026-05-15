<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\CarrelloController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProfileController;
use App\http\Controllers\InfoController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes - Librooz E-commerce
|--------------------------------------------------------------------------
*/

// Schermata di caricamento iniziale
Route::get('/', function () { return view('loading'); })->name('loading');

// Home e Catalogo pubblico
Route::get('/home', [LibroController::class, 'index'])->name('home');
Route::get('/catalogo', [LibroController::class, 'catalogo'])->name('catalogo');
Route::get('/libri/{id}', [LibroController::class, 'show'])->name('libri.show');

// Rotte Informative del Footer
Route::get('/chi-siamo', [InfoController::class, 'chiSiamo'])->name('info.chi-siamo');
Route::get('/spedizioni', [InfoController::class, 'spedizioni'])->name('info.spedizioni');
Route::get('/resi-rimborsi', [InfoController::class, 'resiRimborsi'])->name('info.resi');
Route::get('/faq', [InfoController::class, 'faq'])->name('info.faq');

// Rotte Wishlist pubbliche (Ospiti + Loggati)
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/aggiungi/{id}', [WishlistController::class, 'aggiungi'])->name('wishlist.add');
Route::delete('/wishlist/rimuovi/{id}', [WishlistController::class, 'rimuovi'])->name('wishlist.remove');

// Rotte Carrello pubbliche
Route::get('/carrello', [CarrelloController::class, 'index'])->name('carrello.index');
Route::post('/carrello/aggiungi/{id}', [CarrelloController::class, 'aggiungi'])->name('carrello.add');
Route::post('/carrello/aggiorna/{id}', [CarrelloController::class, 'aggiornaCarrello'])->name('carrello.aggiorna');
Route::delete('/carrello/rimuovi/{id}', [CarrelloController::class, 'rimuovi'])->name('carrello.remove');

// Rotte Protette da Autenticazione (Solo utenti loggati)
Route::middleware('auth')->group(function () {
    
    // 👤 Profilo Utente (Allineato a Laravel Breeze)
    Route::get('/profilo', [ProfileController::class, 'edit'])->name('profile.index');
    Route::patch('/profilo', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profilo', [ProfileController::class, 'destroy'])->name('profile.destroy');



Route::get('/ordini', [OrderController::class, 'index'])->name('orders.index');

    // 🛒 Checkout (Pagina di finto pagamento)
    Route::get('/checkout', [CarrelloController::class, 'mostraCheckout'])->name('checkout.index');
    Route::post('/checkout/conferma', [CarrelloController::class, 'confermaOrdine'])->name('checkout.conferma');
    
    // 🔧 Pannello Admin.
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/libri/store', [AdminController::class, 'storeLibro'])->name('admin.libri.store');
});

require __DIR__.'/auth.php';