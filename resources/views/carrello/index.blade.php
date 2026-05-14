@extends('layouts.app')

@section('title', 'Il tuo Carrello')

@section('content')
<div class="container my-5" style="max-width: 1100px; margin: auto; padding: 20px; font-family: sans-serif;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 10px;">
        <h1 style="margin: 0; color: #2c3e50;">🛒 Il tuo Carrello</h1>
        <a href="{{ route('home') }}" style="text-decoration: none; color: #3498db; font-weight: bold;">&larr; Continua lo Shopping</a>
    </div>

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
            {{ session('success') }}
        </div>
    @endif

    @if($elementi->isEmpty())
        <div style="text-align: center; padding: 60px 20px; background: #fdfdfd; border: 1px dashed #ccc; border-radius: 10px;">
            <p style="font-size: 1.2rem; color: #7f8c8d;">Non ci sono libri nel tuo carrello al momento.</p>
            <a href="{{ route('home') }}" style="display: inline-block; margin-top: 15px; background: #3498db; color: white; padding: 10px 25px; border-radius: 5px; text-decoration: none;">Scopri i nostri Libri</a>
        </div>
    @else
        <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <thead>
                <tr style="background-color: #f8f9fa; text-align: left; border-bottom: 2px solid #dee2e6;">
                    <th style="padding: 15px;">Prodotto</th>
                    <th style="padding: 15px; text-align: center;">Quantità</th>
                    <th style="padding: 15px; text-align: right;">Prezzo Unitario</th>
                    <th style="padding: 15px; text-align: right;">Totale</th>
                    <th style="padding: 15px; text-align: center;">Azione</th>
                </tr>
            </thead>
            <tbody>
                @php $totaleGenerale = 0; @endphp
                @foreach($elementi as $item)
                    @php 
                        // Gestione ibrida DB (oggetto Carrello) e Sessione (oggetto stdClass)
                        $libro = $item->libro ?? $item;
                        $titolo = $libro->titolo;
                        $prezzo = $libro->prezzo;
                        $id_libro = $libro->id_libro;
                        $subtotale = $prezzo * $item->quantita;
                        $totaleGenerale += $subtotale;
                    @endphp
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 15px;">
                            <span style="font-weight: bold; color: #34495e;">{{ $titolo }}</span>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            {{ $item->quantita }}
                        </td>
                        <td style="padding: 15px; text-align: right;">
                            {{ number_format($prezzo, 2, ',', '.') }}€
                        </td>
                        <td style="padding: 15px; text-align: right; font-weight: bold; color: #2c3e50;">
                            {{ number_format($subtotale, 2, ',', '.') }}€
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <form action="{{ route('carrello.remove', $id_libro) }}" method="POST" onsubmit="return confirm('Rimuovere questo libro dal carrello?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #e74c3c; cursor: pointer; font-size: 1.1rem;" title="Rimuovi">
                                    🗑️
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 30px; display: flex; flex-direction: column; align-items: flex-end;">
            <div style="font-size: 1.4rem; margin-bottom: 20px;">
                Totale Ordine: <span style="font-weight: bold; color: #27ae60;">{{ number_format($totaleGenerale, 2, ',', '.') }}€</span>
            </div>
            
            @auth
                <form action="{{ route('orders.index') }}" method="GET"> {{-- Sostituisci con la rotta di pagamento reale --}}
                    <button type="submit" style="background: #27ae60; color: white; padding: 12px 40px; border: none; border-radius: 5px; font-size: 1.1rem; cursor: pointer; font-weight: bold;">
                        Procedi all'ordine &rarr;
                    </button>
                </form>
            @else
                <div style="background: #fff3cd; color: #856404; padding: 10px 20px; border-radius: 5px; border: 1px solid #ffeeba;">
                    ⚠️ <a href="{{ route('login') }}" style="color: #856404; font-weight: bold;">Accedi</a> per completare l'acquisto.
                </div>
            @endauth
        </div>
    @endif
</div>
@endsection