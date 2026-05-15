<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Carrello;
use Illuminate\Support\Facades\Auth;

class CarrelloController extends Controller
{
    // Visualizza il carrello (Database o Sessione)
    public function index()
    {
        if (Auth::check()) {
            // Se loggato, recupera dal DB con le relazioni (libro e autore)
            $elementi = Carrello::with('libro.autore')
                                ->where('id_utente', Auth::id())
                                ->get();
        } else {
            // Se ospite, recupera dalla sessione e trasforma in oggetti per coerenza
            $sessione = session()->get('carrello', []);
            $elementi = collect($sessione)->map(function($item) {
                return (object)$item;
            });
        }

        return view('carrello.index', compact('elementi'));
    }

    // Aggiunge un libro al carrello
    public function aggiungi(Request $request, $id)
    {
        $libro = Libro::findOrFail($id);

        if (Auth::check()) {
            // Logica Database
            $cartItem = Carrello::where('id_utente', Auth::id())
                                ->where('id_libro', $id)
                                ->first();

            if ($cartItem) {
                $cartItem->increment('quantita');
            } else {
                Carrello::create([
                    'id_utente' => Auth::id(),
                    'id_libro' => $id,
                    'quantita' => 1
                ]);
            }
        } else {
            // Logica Sessione
            $carrello = session()->get('carrello', []);
            if(isset($carrello[$id])) {
                $carrello[$id]['quantita']++;
            } else {
                $carrello[$id] = [
                    'id_libro' => $libro->id_libro,
                    'titolo' => $libro->titolo,
                    'prezzo' => $libro->prezzo,
                    'quantita' => 1
                ];
            }
            session()->put('carrello', $carrello);
        }

        return redirect()->route('carrello.index')->with('success', 'Libro aggiunto con successo!');
    }

    // Rimuove un singolo libro dal carrello
    public function rimuovi($id)
    {
        if (Auth::check()) {
            // Elimina dal DB
            Carrello::where('id_utente', Auth::id())
                    ->where('id_libro', $id)
                    ->delete();
        } else {
            // Elimina dalla Sessione
            $carrello = session()->get('carrello', []);
            if(isset($carrello[$id])) {
                unset($carrello[$id]);
                session()->put('carrello', $carrello);
            }
        }

        return redirect()->back()->with('success', 'Libro rimosso dal carrello.');
    }

    // Aggiorna le quantità dai tasti + e -
    public function aggiornaCarrello(Request $request, $id)
    {
        $azione = $request->input('azione'); // 'piu' o 'meno'

        if (Auth::check()) {
            // --- LOGICA DATABASE (Se l'utente è loggato) ---
            $cartItem = Carrello::where('id_utente', Auth::id())
                                ->where('id_libro', $id)
                                ->first();

            if ($cartItem) {
                if ($azione === 'piu') {
                    $cartItem->increment('quantita');
                } elseif ($azione === 'meno') {
                    if ($cartItem->quantita > 1) {
                        $cartItem->decrement('quantita');
                    } else {
                        $cartItem->delete(); // Rimuove se scende sotto 1
                    }
                }
            }
        } else {
            // --- LOGICA SESSIONE (Se l'utente è ospite) ---
            $carrello = session()->get('carrello', []);

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
        }

        return redirect()->back()->with('success', 'Quantità aggiornata con successo!');
    }

    // Mostra la pagina di Checkout (Aggiunto ora)
    public function mostraCheckout()
    {
        if (Auth::check()) {
            $elementi = Carrello::with('libro.autore')
                                ->where('id_utente', Auth::id())
                                ->get();
        } else {
            $sessione = session()->get('carrello', []);
            $elementi = collect($sessione)->map(function($item) {
                return (object)$item;
            });
        }

        if ($elementi->isEmpty()) {
            return redirect()->route('carrello.index')->with('success', 'Il carrello è vuoto!');
        }

        return view('checkout.index', compact('elementi'));
    }
}