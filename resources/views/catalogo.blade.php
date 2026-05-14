@extends('layouts.app')

@section('title', 'Catalogo Libri')

@section('content')
<div class="container my-5" style="max-width: 1200px; margin: auto; padding: 20px;">
    <h1 style="text-align: center; margin-bottom: 40px; color: #2c3e50;">📚 Tutti i nostri Libri</h1>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 30px;">
        @foreach($libri as $libro)
            <div style="background: white; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); overflow: hidden; display: flex; flex-direction: column;">
                
                {{-- Immagine --}}
                <div style="height: 300px; background: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                    @if($libro->copertina)
                        <img src="{{ asset('storage/' . $libro->copertina) }}" alt="{{ $libro->titolo }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <span style="font-size: 4rem;">📖</span>
                    @endif
                </div>

                {{-- Info --}}
                <div style="padding: 20px; flex-grow: 1;">
                    <h3 style="margin: 0; font-size: 1.1rem; height: 2.4em; overflow: hidden;">{{ $libro->titolo }}</h3>
                    <p style="color: #e67e22; font-weight: bold; margin: 10px 0;">
                        {{ $libro->autore->nome ?? 'Autore' }} {{ $libro->autore->cognome ?? '' }}
                    </p>
                    
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 15px;">
                        <span style="font-size: 1.2rem; font-weight: bold; color: #27ae60;">{{ number_format($libro->prezzo, 2, ',', '.') }}€</span>
                        
                        {{-- Tasto Carrello --}}
                        <form action="{{ route('carrello.add', $libro->id_libro) }}" method="POST">
                            @csrf
                            <button type="submit" style="background: #3498db; color: white; border: none; padding: 8px 12px; border-radius: 5px; cursor: pointer; font-weight: bold;">
                                🛒 Aggiungi
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagina 1, 2, 3... --}}
    <div style="margin-top: 40px; display: flex; justify-content: center;">
        {{ $libri->links() }}
    </div>
</div>
@endsection