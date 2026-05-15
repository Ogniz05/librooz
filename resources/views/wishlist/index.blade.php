@extends('layouts.app')

@section('title', 'La mia Wishlist')

@section('content')
    <div class="container my-5" style="max-width: 1100px; margin: auto; padding: 20px; font-family: sans-serif;">
        <div
            style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 10px;">
            <h1 style="margin: 0; color: #2c3e50;">❤️ La mia Lista dei Desideri</h1>
            <a href="{{ route('home') }}" style="text-decoration: none; color: #3498db; font-weight: bold;">&larr; Continua lo
                Shopping</a>
        </div>

        @if (session('success'))
            <div
                style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        @if ($elementi->isEmpty())
            <div
                style="text-align: center; padding: 60px 20px; background: #fdfdfd; border: 1px dashed #ccc; border-radius: 10px;">
                <p style="font-size: 1.2rem; color: #7f8c8d;">La tua lista dei desideri è vuota.</p>
                <a href="{{ route('home') }}"
                    style="display: inline-block; margin-top: 15px; background: #3498db; color: white; padding: 10px 25px; border-radius: 5px; text-decoration: none;">Sfoglia
                    i Libri</a>
            </div>
        @else
            <table
                style="width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <thead>
                    <tr style="background-color: #f8f9fa; text-align: left; border-bottom: 2px solid #dee2e6;">
                        <th style="padding: 15px;">Libro</th>
                        <th style="padding: 15px; text-align: right;">Prezzo</th>
                        <th style="padding: 15px; text-align: center;">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($elementi as $item)
                        @php
                            // Individua l'ID corretto dell'istanza per prevenire discrepanze di mapping
                            $idLibro = $item->id_libro ?? $item->id;
                        @endphp
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 15px;">
                                <span
                                    style="font-weight: bold; color: #34495e;">{{ $item->titolo ?? 'Titolo non disponibile' }}</span>
                            </td>
                            <td style="padding: 15px; text-align: right; font-weight: bold; color: #2c3e50;">
                                {{ number_format($item->prezzo ?? 0, 2, ',', '.') }}€
                            </td>
                            <td
                                style="padding: 15px; text-align: center; display: flex; justify-content: center; gap: 15px; align-items: center;">

                                <form action="{{ route('carrello.add', $idLibro) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <button type="submit"
                                        style="background: #27ae60; color: white; border: none; padding: 6px 15px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 0.9rem;">
                                        🛒 Aggiungi al Carrello
                                    </button>
                                </form>

                                <form action="{{ route('wishlist.remove', $idLibro) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background: none; border: none; color: #e74c3c; cursor: pointer; font-size: 1.2rem;"
                                        title="Rimuovi">
                                        🗑️
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
