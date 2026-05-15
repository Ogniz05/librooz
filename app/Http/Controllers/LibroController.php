<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Autore;
use App\Models\Categoria;

class LibroController extends Controller
{
    public function index()
    {
        $inEvidenza = Libro::with('autore')->take(8)->get();
        $piuVenduti = Libro::with('autore')->take(8)->get(); 
        $ultimiArrivi = Libro::with('autore')->orderBy('id_libro', 'desc')->take(8)->get();

        return view('home', compact('inEvidenza', 'piuVenduti', 'ultimiArrivi'));
    }

    public function catalogo(Request $request)
    {
        $query = Libro::with(['autore', 'categorie']);

        // Filtro per categoria funzionante
        if ($request->has('categoria') && $request->categoria != '') {
            $query->whereHas('categorie', function($q) use ($request) {
                $q->where('Libro_Categoria.id_categoria', $request->categoria);
            });
        }

        $libri = $query->get();
        $categorie = Categoria::all();

        // Recupero dei preferiti dalla sessione per accendere i cuoricini all'avvio
        $wishlistIds = session()->get('wishlist', []);

        return view('catalogo', compact('libri', 'categorie', 'wishlistIds'));
    }

    public function show($id)
    {
        $libro = Libro::with(['autore', 'categorie'])->findOrFail($id);
        return view('libri.show', compact('libro'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titolo' => 'required|string|max:255',
            'prezzo' => 'required|numeric',
            'autore_nome' => 'required|string|max:255',
            'autore_cognome' => 'required|string|max:255',
            'anno_pubblicazione' => 'nullable|integer',
            'trama' => 'nullable|string',
            'copertina' => 'nullable|image|max:2048',
        ]);

        $autore = Autore::firstOrCreate([
            'nome' => $request->input('autore_nome'),
            'cognome' => $request->input('autore_cognome')
        ]);

        $libro = new Libro();
        $libro->titolo = $request->input('titolo');
        $libro->prezzo = $request->input('prezzo');
        $libro->anno_pubblicazione = $request->input('anno_pubblicazione');
        $libro->trama = $request->input('trama');
        $libro->id_autore = $autore->id_autore;

        // --- GESTIONE COPERTINA BLINDATA ---
        if ($request->hasFile('copertina')) {
            $file = $request->file('copertina');
            $filename = time() . '_' . str_replace(' ', '-', strtolower($request->input('titolo'))) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/copertine'), $filename);
            $libro->copertina = 'copertine/' . $filename;
        }

        $libro->save();

        if ($request->has('categorie')) {
            $libro->categorie()->sync($request->input('categorie'));
        }

        return redirect()->back()->with('success', 'Libro aggiunto con successo!');
    }
    
    public function aggiungiAlCarrello(Request $request, $id)
    {
        $libro = Libro::findOrFail($id);
        $carrello = session()->get('carrello', []);

        if(isset($carrello[$id])) {
            $carrello[$id]['quantita']++;
        } else {
            $carrello[$id] = [
                "titolo" => $libro->titolo,
                "quantita" => 1,
                "prezzo" => $libro->prezzo,
                "copertina" => $libro->copertina
            ];
        }

        session()->put('carrello', $carrello);

        // Se la richiesta è AJAX (Fetch), restituiamo una risposta JSON anziché un redirect pesante
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Splendida scelta! Il volume è stato aggiunto al carrello.'
            ]);
        }

        return redirect()->back()->with('success', 'Splendida scelta! Il volume è stato aggiunto al carrello.');
    }

    public function aggiornaCarrello(Request $request, $id)
    {
        $carrello = session()->get('carrello', []);
        $azione = $request->input('azione');

        if (isset($carrello[$id])) {
            if ($azione === 'piu') {
                $carrello[$id]['quantita']++;
            } elseif ($azione === 'meno') {
                $carrello[$id]['quantita']--;
                if ($carrello[$id]['quantita'] < 1) {
                    unset($carrello[$id]);
                }
            }
            
            session()->put('carrello', $carrello);
        }

        return redirect()->back()->with('success', 'Carrello aggiornato!');
    }

    // NUOVA FUNZIONE PER LA WISHLIST IN AJAX
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