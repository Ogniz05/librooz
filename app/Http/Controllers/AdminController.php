<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Autore;
use App\Models\Editore;
use App\Models\Categoria; 
use App\Models\Ordine;    
use App\Models\Utente;    

class AdminController extends Controller
{
    /**
     * 📊 DASHBOARD UNICA - Carica tutti i tab e calcola le statistiche commerciali
     */
    public function dashboard()
    {
        // 1. Recupero dati completi per le tabelle e le relazioni relazionate
        $libri = Libro::with(['autore', 'editore', 'categoria'])->orderBy('id_libro', 'desc')->get();
        $autori = Autore::withCount('libri')->orderBy('nome', 'asc')->get();
        $editori = Editore::withCount('libri')->orderBy('nome', 'asc')->get();
        
        // CORREZIONE: Recuperiamo le categorie senza forzare l'ordinamento sulla colonna 'nome'
        $categorie = Categoria::all(); 
        
        $ordini = Ordine::with('utente')->orderBy('id_ordine', 'desc')->get(); 
        $utenti = Utente::orderBy('id_utente', 'desc')->get(); 
        
        // 2. Calcolo statistiche rapide reali per l'interfaccia luxury
        $stats = [
            'totale_libri' => $libri->count(),
            'valore_magazzino' => $libri->sum('prezzo'),
            'media_prezzo' => $libri->count() > 0 ? $libri->avg('prezzo') : 0,
            'totale_ordini' => $ordini->count(),
            'ordini_in_attesa' => $ordini->where('stato', 'In lavorazione')->count(),
            'totale_utenti' => $utenti->count()
        ];

        // 3. Spedisce tutto alla vista a tab compatti
        return view('admin.dashboard', compact('libri', 'autori', 'editori', 'categorie', 'ordini', 'utenti', 'stats'));
    }

    /**
     * 💾 SALVA LIBRO - Registra il volume, associa Categoria, Autore, Editore e gestisce la copertina
     */
    public function storeLibro(Request $request)
    {
        $request->validate([
            'titolo' => 'required|string|max:255',
            'autore_nome' => 'required|string',
            'autore_cognome' => 'required|string',
            'editore_nome' => 'required|string',
            'id_categoria' => 'required|exists:Categoria,id_categoria', 
            'prezzo' => 'required|numeric',
            'copertina' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // 1. Automatizzazione Autore ed Editore (Evita duplicati)
        $autore = Autore::firstOrCreate([
            'nome' => $request->autore_nome, 
            'cognome' => $request->autore_cognome
        ]);
        
        $editore = Editore::firstOrCreate(['nome' => $request->editore_nome]);

        // 2. Creazione del record Libro
        $libro = new Libro();
        $libro->titolo = $request->titolo;
        $libro->prezzo = $request->prezzo;
        $libro->id_autore = $autore->id_autore;
        $libro->id_editore = $editore->id_editore;
        $libro->id_categoria = $request->id_categoria; 
        $libro->anno_pubblicazione = $request->anno_pubblicazione;
        $libro->trama = $request->trama;

        // 3. Gestione Copertina protetta per Laragon/Windows
        if ($request->hasFile('copertina')) {
            $file = $request->file('copertina');
            $filename = time() . '_' . str_replace(' ', '-', strtolower($request->input('titolo'))) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/copertine'), $filename);
            $libro->copertina = 'copertine/' . $filename;
        } else {
            $libro->copertina = null;
        }

        $libro->save();

        return redirect()->route('admin.dashboard')->with('success', 'Il nuovo volume è stato registrato con successo nel catalogo.');
    }

    /**
     * 📦 AGGIORNA STATO ORDINE - Cambia lo stato della spedizione in tempo reale
     */
    public function aggiornaStatoOrdine(Request $request, $id)
    {
        $request->validate([
            'stato' => 'required|string'
        ]);

        $ordine = Ordine::findOrFail($id);
        $ordine->stato = $request->stato;
        $ordine->save();

        return redirect()->route('admin.dashboard')->with('success', 'Stato dell\'ordine aggiornato con successo.');
    }
}