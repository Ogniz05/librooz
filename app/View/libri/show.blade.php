@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    :root {
        --bronzo: #c5a059;
        --ebano: #1a1a1a;
        --nero-bg: #121212;
        --nero-card: #1e1e1e;
        --testo: #f4f1ea;
        --testo-muted: #a0a0a0;
    }

    body { 
        background-color: var(--nero-bg) !important; 
        color: var(--testo);
        font-family: 'Poppins', sans-serif;
    }

    .book-detail-container {
        padding-top: 60px;
        padding-bottom: 60px;
    }

    /* Stile per la Copertina Grande */
    .cover-wrapper {
        position: sticky;
        top: 40px;
    }

    .large-cover {
        width: 100%;
        max-width: 380px;
        height: auto;
        aspect-ratio: 2/3;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid rgba(197, 160, 89, 0.3);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6);
    }

    .no-cover-placeholder {
        width: 100%;
        max-width: 380px;
        aspect-ratio: 2/3;
        background: var(--nero-card);
        border: 1px solid #333;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6);
    }

    /* Testi e Dettagli */
    .book-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        font-weight: 700;
        color: #fff;
        line-height: 1.2;
        margin-bottom: 10px;
    }

    .book-author {
        font-size: 1.4rem;
        color: var(--bronzo);
        font-weight: 500;
        margin-bottom: 25px;
    }

    .book-meta {
        font-size: 0.9rem;
        color: var(--testo-muted);
        margin-bottom: 30px;
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .badge-genre {
        background: rgba(197, 160, 89, 0.1);
        color: var(--bronzo);
        border: 1px solid rgba(197, 160, 89, 0.3);
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .price-tag {
        font-size: 2rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 30px;
    }

    /* Card della Trama */
    .trama-card {
        background: var(--nero-card);
        border: 1px solid rgba(255, 255, 255, 0.03);
        border-radius: 12px;
        padding: 30px;
        line-height: 1.8;
        color: #e0e0e0;
        font-size: 1.05rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .trama-title {
        font-family: 'Playfair Display', serif;
        color: var(--bronzo);
        font-size: 1.4rem;
        margin-bottom: 15px;
        border-bottom: 1px solid #333;
        padding-bottom: 10px;
    }

    /* Pulsanti */
    .btn-action {
        background: var(--bronzo);
        color: #000;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 14px 30px;
        border-radius: 8px;
        border: none;
        transition: 0.3s;
    }

    .btn-action:hover {
        background: #d4af37;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(197, 160, 89, 0.3);
        color: #000;
    }

    .btn-back {
        color: var(--testo-muted);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: 0.3s;
        margin-bottom: 30px;
    }
    .btn-back:hover { color: var(--bronzo); }
</style>

<div class="container book-detail-container">
    <a href="{{ route('home') }}" class="btn-back">
        ⬅️ Torna alla Home
    </a>

    <div class="row g-5">
        <div class="col-lg-4 col-md-5 text-center text-md-start">
            <div class="cover-wrapper">
                @if($libro->copertina)
                    <img src="{{ asset('storage/' . $libro->copertina) }}" class="large-cover" alt="Copertina di {{ $libro->titolo }}">
                @else
                    <div class="no-cover-placeholder">
                        <span style="font-size: 4rem; margin-bottom: 10px;">📖</span>
                        <span class="text-muted small text-uppercase letter-spacing-1">Copertina non disponibile</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-8 col-md-7">
            <h1 class="book-title">{{ $libro->titolo }}</h1>
            <div class="book-author">di {{ $libro->autore->nome ?? '' }} {{ $libro->autore->cognome ?? 'Autore Sconosciuto' }}</div>

            <div class="book-meta">
                @if($libro->anno_pubblicazione)
                    <span>📅 Anno: <strong>{{ $libro->anno_pubblicazione }}</strong></span>
                @endif
                
                <div class="d-flex gap-2 flex-wrap align-items-center mt-2 mt-sm-0">
                    @foreach($libro->categorie as $cat)
                        <span class="badge-genre">{{ $cat->nome_categoria }}</span>
                    @endforeach
                </div>
            </div>

            <div class="price-tag">
                <span style="font-size: 1.2rem; color: var(--testo-muted); font-weight: 400;">Prezzo di copertina:</span><br>
                <span style="color: var(--bronzo);">€{{ number_format($libro->prezzo, 2) }}</span>
            </div>

            <div class="trama-card mb-4">
                <h3 class="trama-title">Sinossi dell'opera</h3>
                @if($libro->trama)
                    <p class="mb-0" style="white-space: pre-line;">{{ $libro->trama }}</p>
                @else
                    <p class="text-muted italic mb-0">Nessuna trama disponibile per questo volume.</p>
                @endif
            </div>

            @if(session('success'))
    <div class="alert alert-success bg-dark text-success border-secondary mb-4">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('carrello.aggiungi', $libro->id_libro ?? $libro->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn-buy shadow">
        <i class="fas fa-shopping-bag me-2"></i> Aggiungi al Carrello
    </button>
</form>
        </div>
    </div>
</div>
@endsection