<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\CarrelloController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InfoController;
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

// Rotte Wishlist pubbliche
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/aggiungi/{id}', [WishlistController::class, 'aggiungi'])->name('wishlist.add');
Route::delete('/wishlist/rimuovi/{id}', [WishlistController::class, 'rimuovi'])->name('wishlist.remove');
Route::post('/wishlist/toggle', [WishlistController::class, 'gestisciWishlist'])->name('wishlist.toggle');

// Rotte Carrello pubbliche
Route::get('/carrello', [CarrelloController::class, 'index'])->name('carrello.index');
Route::post('/carrello/aggiungi/{id}', [CarrelloController::class, 'aggiungi'])->name('carrello.add');
Route::post('/carrello/aggiorna/{id}', [CarrelloController::class, 'aggiornaCarrello'])->name('carrello.aggiorna');
Route::delete('/carrello/rimuovi/{id}', [CarrelloController::class, 'rimuovi'])->name('carrello.remove');

// =========================================================================
// 🔒 ROTTE PROTETTE DA AUTENTICAZIONE (Solo utenti loggati)
// =========================================================================
Route::middleware('auth')->group(function () {
    
    // 👤 Profilo Utente (Allineato a Laravel Breeze)
    Route::get('/profilo', [ProfileController::class, 'edit'])->name('profile.index');
    Route::patch('/profilo', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profilo', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/ordini', [OrderController::class, 'index'])->name('orders.index');

    // 🛒 Checkout (Pagina di finto pagamento)
    Route::get('/checkout', [CarrelloController::class, 'mostraCheckout'])->name('checkout.index');
    Route::post('/checkout/conferma', [CarrelloController::class, 'confermaOrdine'])->name('checkout.conferma');
    
    // =========================================================================
    // ⚙️ AREA ADMIN (Protetta tramite controllo d'accesso nel group)
    // =========================================================================
    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => function ($request, $next) {
            if (!Auth::user() || !Auth::user()->isAdmin()) {
                return redirect('/home')->with('error', 'Accesso negato. Non hai i permessi di Amministratore.');
            }
            return $next($request);
        }
    ], function () {

        // Pannello Unico Commerciale (Dashboard con statistiche, form e tabelle a tab)
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Azione di salvataggio del nuovo libro (Form)
        Route::post('/libri/store', [AdminController::class, 'storeLibro'])->name('libri.store');
        
        // Azione di aggiornamento stato per gli ordini dei clienti
        Route::patch('/ordini/{id}/stato', [AdminController::class, 'aggiornaStatoOrdine'])->name('ordini.updateStato');

    });

});

require __DIR__.'/auth.php';