<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

class WishlistController extends Controller
{
    // Mostra la lista dei desideri
    public function index()
    {
        // Recupera la wishlist dalla sessione (array vuoto se non esiste)
        $wishlistSessione = session()->get('wishlist', []);

        // Trasformiamo l'array in una collezione di oggetti per gestirla agilmente nella vista
        $elementi = collect($wishlistSessione)->map(function($item) {
            return (object)$item;
        });

        return view('wishlist.index', compact('elementi'));
    }

    // Aggiunge un libro alla lista dei desideri
    public function aggiungi($id)
    {
        $libro = Libro::findOrFail($id);
        $wishlist = session()->get('wishlist', []);

        // Se il libro non è già presente, lo aggiungiamo
        if (!isset($wishlist[$id])) {
            $wishlist[$id] = [
                'id_libro' => $libro->id_libro,
                'titolo' => $libro->titolo,
                'prezzo' => $libro->prezzo,
            ];
            
            session()->put('wishlist', $wishlist);
            return redirect()->back()->with('success', 'Libro aggiunto alla Wishlist! ❤️');
        }

        return redirect()->back()->with('success', 'Il libro è già nella tua Wishlist!');
    }

    // Rimuove un libro dalla lista dei desideri
    public function rimuovi($id)
    {
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$id])) {
            unset($wishlist[$id]);
            session()->put('wishlist', $wishlist);
        }

        return redirect()->back()->with('success', 'Libro rimosso dalla Wishlist.');
    }
}