@extends('layouts.app')

@section('title', 'I miei Ordini')

@section('content')
    <div class="container my-5" style="max-width: 900px; margin: auto; padding: 20px; font-family: sans-serif;">

        <div style="border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 30px;">
            <h1 style="color: #2c3e50; margin: 0;">📦 I miei Ordini</h1>
            <p style="color: #7f8c8d; margin: 5px 0 0 0;">Visualizza lo storico degli acquisti e traccia le spedizioni.</p>
        </div>

        @if (count($ordini) > 0)
            @foreach ($ordini as $ordine)
                <div
                    style="background: white; border: 1px solid #dee2e6; border-radius: 8px; margin-bottom: 25px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); overflow: hidden;">

                    {{-- Intestazione del singolo ordine --}}
                    <div
                        style="background: #f8f9fa; padding: 15px 20px; border-bottom: 1px solid #dee2e6; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                        <div>
                            <span
                                style="color: #7f8c8d; font-size: 0.85rem; display: block; text-transform: uppercase;">Codice
                                Ordine</span>
                            <strong style="color: #2c3e50;">{{ $ordine['id'] }}</strong>
                        </div>
                        <div>
                            <span
                                style="color: #7f8c8d; font-size: 0.85rem; display: block; text-transform: uppercase;">Data</span>
                            <strong style="color: #2c3e50;">{{ $ordine['data'] }}</strong>
                        </div>
                        <div>
                            <span
                                style="color: #7f8c8d; font-size: 0.85rem; display: block; text-transform: uppercase;">Totale</span>
                            <strong style="color: #e74c3c;">{{ number_format($ordine['totale'], 2) }} €</strong>
                        </div>
                        <div>
                            <span
                                style="background: {{ $ordine['colore_stato'] }}; color: white; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: bold;">
                                {{ $ordine['stato'] }}
                            </span>
                        </div>
                    </div>

                    {{-- Corpo dell'ordine (I libri comprati) --}}
                    <div style="padding: 20px;">
                        <h4
                            style="margin-top: 0; margin-bottom: 15px; color: #34495e; border-bottom: 1px solid #f1f2f6; padding-bottom: 5px;">
                            Articoli acquistati:</h4>

                        @foreach ($ordine['libri'] as $libro)
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px dashed #eee;">
                                <div>
                                    <h5 style="margin: 0; color: #2c3e50; font-size: 1rem;">{{ $libro['titolo'] }}</h5>
                                    <p style="margin: 2px 0 0 0; color: #7f8c8d; font-size: 0.85rem;">di
                                        {{ $libro['autore'] }}</p>
                                </div>
                                <div style="text-align: right;">
                                    <span style="color: #7f8c8d; font-size: 0.9rem;">Q.tà: {{ $libro['quantita'] }}</span>
                                    <strong
                                        style="display: block; color: #2c3e50; font-size: 0.95rem;">{{ number_format($libro['prezzo'], 2) }}
                                        €</strong>
                                </div>
                            </div>
                        @endforeach

                        {{-- Info di Tracciamento fittizia --}}
                        <div
                            style="margin-top: 15px; background: #f1f2f6; padding: 10px 15px; border-radius: 6px; font-size: 0.9rem; color: #57606f; display: flex; justify-content: space-between; align-items: center;">
                            <span>🚚 Numero Tracking: <strong>{{ $ordine['tracking'] }}</strong></span>
                            <a href="#" style="color: #3498db; text-decoration: none; font-weight: bold;">Traccia
                                pacco →</a>
                        </div>
                    </div>

                </div>
            @endforeach
        @else
            <div
                style="text-align: center; padding: 40px; background: #f8f9fa; border-radius: 8px; border: 1px dashed #ccc;">
                <p style="color: #7f8c8d; font-size: 1.1rem; margin-bottom: 20px;">Non hai ancora effettuato nessun ordine.
                </p>
                <a href="{{ route('catalogo') }}"
                    style="background: #3498db; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">Sfoglia
                    il Catalogo</a>
            </div>
        @endif

    </div>
@endsection
