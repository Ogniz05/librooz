<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

class LibroController extends Controller
{
    public function index()
    {
        // Usiamo l'ID per l'ordine visto che non hai created_at
        $inEvidenza = Libro::with('autore')->orderBy('id_libro', 'desc')->take(4)->get();
        $nuoviArrivi = Libro::with('autore')->take(4)->get();

        return view('home', compact('inEvidenza', 'nuoviArrivi'));
    }

    public function catalogo()
    {
        // Recuperiamo tutti i libri per la pagina catalogo
        $libri = Libro::with('autore')->paginate(12);
        
        return view('catalogo', compact('libri'));
    }
}