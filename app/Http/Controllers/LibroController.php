<?php
namespace App\Http\Controllers;

use App\Models\Libro;

class LibroController extends Controller
{
    public function index()
    {
        $inEvidenza = Libro::with('autore')->take(10)->get();
        $ultimiArrivi = Libro::with('autore')->latest('anno_pubblicazione')->take(10)->get();

        return view('home', compact('inEvidenza', 'ultimiArrivi'));
    }
}