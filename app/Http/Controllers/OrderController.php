<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Recuperiamo l'utente loggato
        $user = Auth::user();

        // Simuliamo uno storico di ordini effettuati dall'utente
        $ordini = [
            [
                'id' => 'ORD-2026-9831',
                'data' => '10/05/2026',
                'stato' => 'In transito',
                'colore_stato' => '#f39c12', // Arancione
                'totale' => 42.80,
                'tracking' => 'IT123456789X',
                'libri' => [
                    ['titolo' => 'Il Signore degli Anelli', 'autore' => 'J.R.R. Tolkien', 'quantita' => 1, 'prezzo' => 25.00],
                    ['titolo' => '1984', 'autore' => 'George Orwell', 'quantita' => 1, 'prezzo' => 17.80]
                ]
            ],
            [
                'id' => 'ORD-2026-4412',
                'data' => '14/04/2026',
                'stato' => 'Consegnato',
                'colore_stato' => '#2ecc71', // Verde
                'totale' => 15.20,
                'tracking' => 'IT987654321Y',
                'libri' => [
                    ['titolo' => 'Il Piccolo Principe', 'autore' => 'Antoine de Saint-Exupéry', 'quantita' => 1, 'prezzo' => 15.20]
                ]
            ]
        ];

        return view('orders.index', compact('ordini', 'user'));
    }
}