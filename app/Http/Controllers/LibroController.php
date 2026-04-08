<?php
namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Support\Facades\Auth;

class LibroController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return view('home');
        }

        $inEvidenza = Libro::with('autore')->take(10)->get();
        $ultimiArrivi = Libro::with('autore')->latest('anno_pubblicazione')->take(10)->get();
        $piuVenduti = Libro::with('autore')->inRandomOrder()->take(10)->get();

        return view('home', compact('inEvidenza', 'ultimiArrivi', 'piuVenduti'));
    }
}