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

        return view('catalogo', compact('libri', 'categorie'));
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

        // --- GESTIONE COPERTINA BLINDATA (Corretta per il tuo server locale) ---
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

    // Recuperiamo il carrello attuale dalla sessione, se non esiste creiamo un array vuoto
        $carrello = session()->get('carrello', []);

    // Se il libro è già nel carrello, aumentiamo la quantità, altrimenti lo aggiungiamo
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

    // Salviamo il carrello aggiornato nella sessione
    session()->put('carrello', $carrello);

    return redirect()->back()->with('success', 'Splendida scelta! Il volume è stato aggiunto al carrello.');
}

public function aggiornaCarrello(Request $request, $id)
{
    $carrello = session()->get('carrello', []);
    $azione = $request->input('azione'); // Riceve 'piu' o 'meno'

    if (isset($carrello[$id])) {
        if ($azione === 'piu') {
            $carrello[$id]['quantita']++;
        } elseif ($azione === 'meno') {
            $carrello[$id]['quantita']--;
            
            // Se la quantità scende a 0, rimuoviamo completamente il libro
            if ($carrello[$id]['quantita'] < 1) {
                unset($carrello[$id]);
            }
        }
        
        session()->put('carrello', $carrello);
    }

    return redirect()->back()->with('success', 'Carrello aggiornato!');
}


}