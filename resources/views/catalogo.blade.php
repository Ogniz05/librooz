@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    body { background: #0a0a0a !important; color: #e0e0e0; font-family: 'Poppins', sans-serif; }
    .catalogo-titolo { font-family: 'Playfair Display'; color: #c5a059; margin-bottom: 1rem; text-align: center; }
    
    /* Barra di Filtro */
    .filter-bar { background: #141414; border: 1px solid #222; border-radius: 12px; padding: 1rem; margin-bottom: 3rem; }
    .form-select-custom { background: #000 !important; border: 1px solid #333 !important; color: #fff !important; color-scheme: dark; }
    .btn-filter { background: #c5a059; color: #000; font-weight: 600; border: none; }

    /* Griglia Libri */
    .libro-card { 
        background: #141414; border: 1px solid #222; border-radius: 15px; 
        overflow: hidden; transition: transform 0.3s, box-shadow 0.3s; height: 100%; display: flex; flex-column: column;
    }
    .libro-card:hover { 
        transform: translateY(-5px); box-shadow: 0 10px 20px rgba(197, 160, 89, 0.2); border-color: #c5a059;
    }
    
    .copertina-wrap { height: 320px; background: #0f0f0f; overflow: hidden; position: relative; }
    .copertina-img { width: 100%; height: 100%; object-fit: cover; }
    .placeholder-img { height: 100%; display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #333; }

    .libro-corpo { padding: 1.2rem; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between; }
    .libro-prezzo { color: #c5a059; font-weight: 600; font-size: 1.15rem; }
</style>

<div class="container py-5">
    <h1 class="catalogo-titolo">La Nostra Collezione</h1>
    <p class="text-center text-muted mb-4">Esplora i nostri volumi esclusivi</p>

    <div class="filter-bar shadow">
        <form action="{{ route('catalogo') }}" method="GET" class="row g-3 align-items-center justify-content-center">
            <div class="col-md-4">
                <select name="categoria" class="form-select form-select-custom">
                    <option value="">Tutte le categorie</option>
                    @foreach($categorie as $cat)
                        <option value="{{ $cat->id_categoria }}" {{ request('categoria') == $cat->id_categoria ? 'selected' : '' }}>
                            {{ $cat->nome_categoria ?? $cat->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-filter w-100 p-2 rounded-3">Filtra</button>
            </div>
        </form>
    </div>

    <div class="row g-4">
        @forelse($libri as $l)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="libro-card">
                
                <div class="copertina-wrap">
                    @if($l->copertina)
                        <img src="{{ asset('storage/' . $l->copertina) }}" class="copertina-img" alt="{{ $l->titolo }}">
                    @else
                        <div class="placeholder-img">📖</div>
                    @endif
                </div>

                <div class="libro-corpo">
                    <div>
                        <h6 class="text-white mb-1 text-truncate" title="{{ $l->titolo }}">{{ $l->titolo }}</h6>
                        <p class="text-muted small mb-2">{{ $l->autore->nome ?? '' }} {{ $l->autore->cognome ?? '' }}</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="libro-prezzo">€ {{ number_format($l->prezzo, 2) }}</span>
                        <a href="{{ route('libri.show', $l->id_libro ?? $l->id) }}" class="btn btn-sm btn-outline-light px-3" style="border-radius: 6px;">Vedi</a>
                    </div>
                </div>

            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">Nessun libro trovato per questa categoria.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection