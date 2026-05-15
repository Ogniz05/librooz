@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container my-5" style="max-width: 1100px; margin: auto; padding: 20px; font-family: sans-serif;">
    <h1 style="color: #2c3e50; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 30px;">🔐 Completamento Ordine</h1>

    <div style="display: flex; gap: 30px; flex-wrap: wrap;">
        
        <div style="flex: 1; min-width: 300px; background: #f8f9fa; padding: 20px; border-radius: 8px; border: 1px solid #dee2e6;">
            <h3 style="margin-top: 0; color: #34495e;">Riepilogo Carrello</h3>
            
            <ul style="list-style: none; padding: 0; margin: 0;">
                @php $totaleGenerale = 0; @endphp
                @foreach($elementi as $item)
                    @php 
                        $libro = $item->libro ?? $item;
                        $subtotale = $libro->prezzo * $item->quantita;
                        $totaleGenerale += $subtotale;
                    @endphp
                    <li style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #ddd;">
                        <div>
                            <strong style="color: #2c3e50;">{{ $libro->titolo }}</strong>
                            <span style="color: #7f8c8d; font-size: 0.9rem; d-block;">(x{{ $item->quantita }})</span>
                        </div>
                        <span style="font-weight: bold; color: #2c3e50;">{{ number_format($subtotale, 2, ',', '.') }}€</span>
                    </li>
                @endforeach
            </ul>

            <div style="margin-top: 20px; padding-top: 15px; border-top: 2px solid #2c3e50; display: flex; justify-content: space-between; font-size: 1.3rem;">
                <strong>Totale da Pagare:</strong>
                <span style="font-weight: bold; color: #27ae60;">{{ number_format($totaleGenerale, 2, ',', '.') }}€</span>
            </div>
        </div>

        <div style="flex: 1.2; min-width: 350px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #eee;">
            <h3 style="margin-top: 0; color: #34495e;">Dati di Spedizione e Pagamento</h3>
            
            <form action="#" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
                @csrf
                
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #2c3e50;">Indirizzo di Spedizione</label>
                    <input type="text" name="indirizzo" required placeholder="Via Roma 12, Milano" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                </div>

                <div style="display: flex; gap: 15px;">
                    <div style="flex: 2;">
                        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #2c3e50;">Città</label>
                        <input type="text" name="citta" required placeholder="Milano" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #2c3e50;">CAP</label>
                        <input type="text" name="cap" required placeholder="20100" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                    </div>
                </div>

                <hr style="border: 0; border-top: 1px solid #eee; margin: 10px 0;">
                <p style="color: #e67e22; font-weight: bold; margin: 0;">💳 Simulazione Pagamento Sandbox attivo</p>

                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #2c3e50;">Numero Carta (Finto)</label>
                    <input type="text" placeholder="4000 1234 5678 9010" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                </div>

                <button type="submit" style="background: #27ae60; color: white; padding: 15px; border: none; border-radius: 5px; font-size: 1.1rem; cursor: pointer; font-weight: bold; margin-top: 10px;">
                    Confirm Order & Pay €{{ number_format($totaleGenerale, 2, ',', '.') }}
                </button>
            </form>
        </div>

    </div>
</div>
@endsection