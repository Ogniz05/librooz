@extends('layouts.app')

@section('title', 'Home — Librooz')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;600;700&display=swap');

    /* ===== HERO ===== */
    .hero {
        background: linear-gradient(135deg, var(--ebano) 60%, var(--tabacco));
        color: var(--carta);
        padding: 5rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: 'LIBROOZ';
        font-family: 'Bebas Neue', sans-serif;
        font-size: 20vw;
        color: rgba(255,255,255,0.03);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        white-space: nowrap;
        pointer-events: none;
    }

    .hero-tag {
        font-family: 'Inter', sans-serif;
        font-size: 0.75rem;
        letter-spacing: 4px;
        text-transform: uppercase;
        color: var(--bronzo);
        margin-bottom: 1rem;
    }

    .hero h1 {
        font-family: 'Bebas Neue', sans-serif;
        font-size: clamp(3rem, 8vw, 6rem);
        letter-spacing: 3px;
        line-height: 1;
        margin-bottom: 1rem;
    }

    .hero h1 span { color: var(--bronzo); }

    .hero p {
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        color: var(--cemento);
        max-width: 500px;
        margin: 0 auto 2rem;
        line-height: 1.7;
    }

    .hero-buttons { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }

    .btn-primary {
        background: var(--bronzo);
        color: var(--ebano);
        padding: 14px 32px;
        border-radius: 4px;
        text-decoration: none;
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        transition: background 0.3s, transform 0.2s;
    }

    .btn-primary:hover { background: var(--tabacco); color: var(--carta); transform: translateY(-2px); }

    .btn-secondary {
        border: 1px solid var(--cemento);
        color: var(--carta);
        padding: 14px 32px;
        border-radius: 4px;
        text-decoration: none;
        font-family: 'Inter', sans-serif;
        font-size: 0.85rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        transition: border-color 0.3s, color 0.3s;
    }

    .btn-secondary:hover { border-color: var(--bronzo); color: var(--bronzo); }

    /* ===== SEZIONI ===== */
    .section { padding: 3rem 2rem; max-width: 1400px; margin: 0 auto; }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid var(--ebano);
        padding-bottom: 0.8rem;
    }

    .section-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 2rem;
        color: var(--ebano);
        letter-spacing: 2px;
    }

    .section-link {
        font-family: 'Inter', sans-serif;
        font-size: 0.8rem;
        color: var(--bronzo);
        text-decoration: none;
        letter-spacing: 2px;
        text-transform: uppercase;
        transition: color 0.3s;
    }

    .section-link:hover { color: var(--tabacco); }

    /* ===== CAROSELLO ===== */
    .carousel-wrapper { position: relative; }

    .carousel {
        display: flex;
        gap: 1.2rem;
        overflow-x: auto;
        scroll-behavior: smooth;
        padding-bottom: 1rem;
        scrollbar-width: none;
    }

    .carousel::-webkit-scrollbar { display: none; }

    .carousel-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: var(--ebano);
        color: var(--carta);
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        font-size: 1.1rem;
        cursor: pointer;
        z-index: 10;
        transition: background 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .carousel-btn:hover { background: var(--bronzo); }
    .carousel-btn.prev { left: -20px; }
    .carousel-btn.next { right: -20px; }

    /* ===== CARD LIBRO ===== */
    .card-libro {
        min-width: 160px;
        max-width: 160px;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s, box-shadow 0.3s;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .card-libro:hover { transform: translateY(-5px); box-shadow: 0 12px 30px rgba(0,0,0,0.15); }

    .card-cover {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: linear-gradient(135deg, var(--tabacco), var(--ebano));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
    }

    .card-cover img { width: 100%; height: 100%; object-fit: cover; }

    .card-body { padding: 10px 12px 14px; }

    .card-titolo {
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        font-size: 0.82rem;
        color: var(--ebano);
        margin-bottom: 3px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-autore {
        font-family: 'Inter', sans-serif;
        font-size: 0.72rem;
        color: var(--cemento);
        margin-bottom: 6px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-prezzo {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.1rem;
        color: var(--bronzo);
        letter-spacing: 1px;
    }

    .card-btn {
        display: block;
        width: 100%;
        margin-top: 8px;
        background: var(--bronzo);
        color: white;
        border: none;
        border-radius: 4px;
        padding: 7px;
        font-size: 0.68rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.3s;
    }

    .card-btn:hover { background: var(--tabacco); }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: var(--cemento);
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
    }

    /* ===== BANNER ===== */
    .banner {
        background: linear-gradient(135deg, var(--tabacco), var(--ebano));
        margin: 1rem 2rem;
        border-radius: 12px;
        padding: 3rem 3.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .banner-left h2 {
        font-family: 'Bebas Neue', sans-serif;
        font-size: clamp(2rem, 5vw, 3.5rem);
        color: var(--carta);
        letter-spacing: 3px;
        line-height: 1.1;
        margin-bottom: 0.5rem;
    }

    .banner-left h2 span { color: var(--bronzo); }

    .banner-left p {
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        color: rgba(255,255,255,0.6);
        max-width: 400px;
    }

    .banner-emoji { font-size: 5rem; }
</style>
@endpush

@section('content')

    {{-- HERO --}}
    <section class="hero">
        <p class="hero-tag">The Online Bookspace</p>
        <h1>Il tuo prossimo <span>libro</span><br>ti sta aspettando</h1>
        <p>Scopri migliaia di titoli, dai classici ai nuovi arrivi. Ordina comodamente da casa.</p>
        <div class="hero-buttons">
            <a href="{{ route('catalogo') }}" class="btn-primary">Esplora il catalogo</a>
            <a href="{{ route('register') }}" class="btn-secondary">Registrati gratis</a>
        </div>
    </section>

    {{-- LIBRI IN EVIDENZA --}}
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">📚 Libri in Evidenza</h2>
            <a href="{{ route('catalogo') }}" class="section-link">Vedi tutti →</a>
        </div>
        <div class="carousel-wrapper">
            <button class="carousel-btn prev" onclick="scrollCarousel('evidenza', -1)">‹</button>
            <div class="carousel" id="evidenza">
                @forelse($inEvidenza as $libro)
                    <a href="#" class="card-libro">
                        <div class="card-cover">📖</div>
                        <div class="card-body">
                            <p class="card-titolo">{{ $libro->titolo }}</p>
                            <p class="card-autore">{{ $libro->autore->nome ?? '' }} {{ $libro->autore->cognome ?? '' }}</p>
                            <p class="card-prezzo">€ {{ number_format($libro->prezzo, 2, ',', '.') }}</p>
                            <button class="card-btn">+ Carrello</button>
                        </div>
                    </a>
                @empty
                    <div class="empty-state">Nessun libro disponibile al momento.</div>
                @endforelse
            </div>
            <button class="carousel-btn next" onclick="scrollCarousel('evidenza', 1)">›</button>
        </div>
    </div>

    {{-- BANNER PROMOZIONALE --}}
    <div class="banner">
        <div class="banner-left">
            <h2>Spedizione <span>gratuita</span><br>sopra i 25€</h2>
            <p>Ordina adesso e ricevi i tuoi libri direttamente a casa tua in pochi giorni.</p>
        </div>
        <div class="banner-emoji">🚚</div>
    </div>

    {{-- ULTIMI ARRIVI --}}
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">🆕 Ultimi Arrivi</h2>
            <a href="{{ route('catalogo') }}" class="section-link">Vedi tutti →</a>
        </div>
        <div class="carousel-wrapper">
            <button class="carousel-btn prev" onclick="scrollCarousel('arrivi', -1)">‹</button>
            <div class="carousel" id="arrivi">
                @forelse($ultimiArrivi as $libro)
                    <a href="#" class="card-libro">
                        <div class="card-cover">📗</div>
                        <div class="card-body">
                            <p class="card-titolo">{{ $libro->titolo }}</p>
                            <p class="card-autore">{{ $libro->autore->nome ?? '' }} {{ $libro->autore->cognome ?? '' }}</p>
                            <p class="card-prezzo">€ {{ number_format($libro->prezzo, 2, ',', '.') }}</p>
                            <button class="card-btn">+ Carrello</button>
                        </div>
                    </a>
                @empty
                    <div class="empty-state">Nessun libro disponibile al momento.</div>
                @endforelse
            </div>
            <button class="carousel-btn next" onclick="scrollCarousel('arrivi', 1)">›</button>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    function scrollCarousel(id, direction) {
        const carousel = document.getElementById(id);
        carousel.scrollBy({ left: direction * 500, behavior: 'smooth' });
    }
</script>
@endpush