<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

class WishlistController extends Controller
{
    /**
     * Mostra la lista dei desideri dell'utente.
     */
    public function index()
    {
        // 1. Recuperiamo l'array semplice di ID dei libri salvati in sessione (es. [4, 7])
        $wishlistIds = session()->get('wishlist', []);

        // 2. Se la wishlist non è vuota, carichiamo i modelli reali di Libro con i dati completi
        if (!empty($wishlistIds)) {
            // Con con('autore') carichiamo anche l'autore per evitare errori nella card della tabella
            $elementi = Libro::with('autore')
                ->whereIn('id_libro', $wishlistIds) // o 'id' a seconda della tua chiave primaria nel DB
                ->get();
        } else {
            // Se la sessione è vuota, passiamo una collezione Eloquent vuota
            $elementi = collect();
        }

        // 3. Passiamo la variabile $elementi esatta richiesta dalla vista
        return view('wishlist.index', compact('elementi'));
    }

    /**
     * Aggiunge un libro alla lista dei desideri (Sincrono / Standard)
     */
    public function aggiungi($id)
    {
        $libro = Libro::findOrFail($id);
        $id_libro = $libro->id_libro ?? $libro->id;
        
        $wishlist = session()->get('wishlist', []);

        // Uniformato: salviamo solo l'ID numerico puro se non è già presente nell'elenco
        if (!in_array($id_libro, $wishlist)) {
            $wishlist[] = $id_libro;
            session()->put('wishlist', $wishlist);
            
            return redirect()->back()->with('success', 'Libro aggiunto alla Wishlist! ❤️');
        }

        return redirect()->back()->with('success', 'Il libro è già nella tua Wishlist!');
    }

    /**
     * Rimuove un libro dalla lista dei desideri (Sincrono / Standard)
     */
    public function rimuovi($id)
    {
        $wishlist = session()->get('wishlist', []);

        // Uniformato: cerca l'ID all'interno dell'array semplice e lo elimina
        if (($key = array_search($id, $wishlist)) !== false) {
            unset($wishlist[$key]);
            // Riavvolge gli indici numerici dell'array per evitare buchi nella sessione
            session()->put('wishlist', array_values($wishlist));
        }

        return redirect()->back()->with('success', 'Libro rimosso dalla Wishlist.');
    }

    /**
     * Gestisce l'aggiunta/rimozione asincrona (AJAX) dal catalogo principale
     */
    public function gestisciWishlist(Request $request)
    {
        $id_libro = $request->input('id_libro');
        $wishlist = session()->get('wishlist', []);

        if (in_array($id_libro, $wishlist)) {
            // Se il libro è già nei preferiti, lo rimuoviamo
            $wishlist = array_diff($wishlist, [$id_libro]);
            session()->put('wishlist', array_values($wishlist));
            
            return response()->json([
                'status' => 'rimosso',
                'message' => 'Rimosso dalla Wishlist'
            ]);
        } else {
            // Se non c'è, lo aggiungiamo
            $wishlist[] = $id_libro;
            session()->put('wishlist', $wishlist);
            
            return response()->json([
                'status' => 'aggiunto',
                'message' => 'Aggiunto alla Wishlist!'
            ]);
        }
    }
}