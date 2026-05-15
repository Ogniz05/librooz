<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Autore;
use App\Models\Editore;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Recupero dati per le tabelle e le sezioni
        $libri = Libro::with(['autore', 'editore'])->orderBy('id_libro', 'desc')->get();
        $autori = Autore::withCount('libri')->get();
        $editori = Editore::withCount('libri')->get();
        
        // Calcolo statistiche rapide
        $stats = [
            'totale_libri' => $libri->count(),
            'valore_magazzino' => $libri->sum('prezzo'),
            'media_prezzo' => $libri->count() > 0 ? $libri->avg('prezzo') : 0
        ];

        return view('admin.dashboard', compact('libri', 'autori', 'editori', 'stats'));
    }

    public function storeLibro(Request $request)
    {
        $request->validate([
            'titolo' => 'required|string|max:255',
            'autore_nome' => 'required|string',
            'autore_cognome' => 'required|string',
            'editore_nome' => 'required|string',
            'prezzo' => 'required|numeric',
            'copertina' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // 1. Automatizzazione Autore ed Editore
        $autore = Autore::firstOrCreate([
            'nome' => $request->autore_nome, 
            'cognome' => $request->autore_cognome
        ]);
        
        $editore = Editore::firstOrCreate(['nome' => $request->editore_nome]);

        // 2. Creazione Libro
        $libro = new Libro();
        $libro->titolo = $request->titolo;
        $libro->prezzo = $request->prezzo;
        $libro->id_autore = $autore->id_autore;
        $libro->id_editore = $editore->id_editore;
        $libro->anno_pubblicazione = $request->anno_pubblicazione;
        $libro->trama = $request->trama;

// --- 3. GESTIONE COPERTINA BLINDATA (Sostituisci le righe 57-61) ---
        if ($request->hasFile('copertina')) {
            $file = $request->file('copertina');
            
            // Generiamo un nome unico pulito basato sul tempo (es: 1715690000_copertina.jpg)
            $filename = time() . '_' . str_replace(' ', '-', strtolower($request->input('titolo'))) . '.' . $file->getClientOriginalExtension();
            
            // Spostiamo fisicamente il file nella cartella public/storage/copertine
            $file->move(public_path('storage/copertine'), $filename);
            
            // Salviamo nel database solo il percorso relativo da usare nel Blade
            $libro->copertina = 'copertine/' . $filename;
        } else {
            $libro->copertina = null;
        }

        $libro->save();

        return redirect()->back()->with('success', 'Il nuovo volume è stato registrato nel catalogo.');
    }
}