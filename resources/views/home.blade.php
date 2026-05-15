@extends('layouts.app')

@section('title', 'Home — Librooz')

@push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;600;700&display=swap');

        body {
            background-color: var(--carta);
            color: var(--ebano);
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        /* ===== MICRO-ANIMAZIONI DI INGRESSO (HERO) ===== */
        @keyframes techFadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
                filter: blur(6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
                filter: blur(0);
            }
        }

        @keyframes floatAnim {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-15px) rotate(1.5deg);
            }
        }

        /* ===== NUOVA IMPAGINAZIONE HERO (DIAGONALE E ASIMMETRICA) ===== */
        .hero {
            background: linear-gradient(135deg, var(--ebano) 65%, var(--tabacco));
            color: var(--carta);
            padding: 6rem 2rem 8rem 2rem;
            position: relative;
            overflow: hidden;
            clip-path: polygon(0 0, 100% 0, 100% 88%, 0 100%);
        }

        .hero-container {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 4rem;
            align-items: center;
            width: 100%;
            text-align: left;
        }

        .hero-content {
            z-index: 2;
        }

        .hero::before {
            content: 'LIBROOZ';
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18vw;
            color: rgba(255, 255, 255, 0.02);
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
            letter-spacing: 5px;
            text-transform: uppercase;
            color: var(--bronzo);
            margin-bottom: 1rem;
            animation: techFadeIn 0.8s ease forwards;
        }

        .hero h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(3rem, 6vw, 5.5rem);
            letter-spacing: 2px;
            line-height: 1.05;
            margin-bottom: 1.5rem;
            animation: techFadeIn 0.8s ease forwards;
        }

        .hero h1 span {
            color: var(--bronzo);
            text-shadow: 0 0 20px rgba(205, 127, 50, 0.3);
        }

        .hero p {
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            color: var(--cemento);
            max-width: 550px;
            margin: 0 0 2.5rem 0;
            line-height: 1.7;
            opacity: 0;
            animation: techFadeIn 0.8s ease forwards;
            animation-delay: 0.2s;
        }

        .hero-buttons {
            display: flex;
            gap: 1.2rem;
            justify-content: flex-start;
            flex-wrap: wrap;
            opacity: 0;
            animation: techFadeIn 0.8s ease forwards;
            animation-delay: 0.4s;
        }

        .btn-primary {
            background: var(--bronzo);
            color: var(--ebano);
            padding: 16px 36px;
            border-radius: 4px;
            text-decoration: none;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            clip-path: polygon(0 0, 92% 0, 100% 30%, 100% 100%, 8% 100%, 0 70%);
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            display: inline-block;
            box-shadow: 0 4px 15px rgba(205, 127, 50, 0.25);
        }

        .btn-primary:hover {
            background: var(--carta);
            color: var(--ebano);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(205, 127, 50, 0.5);
        }

        .btn-secondary {
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--carta);
            padding: 16px 36px;
            border-radius: 4px;
            text-decoration: none;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            clip-path: polygon(0 0, 92% 0, 100% 30%, 100% 100%, 8% 100%, 0 70%);
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-secondary:hover {
            border-color: var(--bronzo);
            color: var(--bronzo);
            background: rgba(205, 127, 50, 0.05);
        }

        .hero-visual {
            display: flex;
            justify-content: center;
            position: relative;
            z-index: 2;
            animation: floatAnim 6s ease-in-out infinite;
        }

        .hero-graphic-element {
            font-size: 10rem;
            user-select: none;
            filter: drop-shadow(0 10px 30px rgba(205, 127, 50, 0.3));
        }

        /* ===== HERO UTENTE LOGGATO MODERNA ===== */
        .hero-loggato {
            background: linear-gradient(135deg, var(--ebano) 70%, var(--tabacco));
            color: var(--carta);
            padding: 4.5rem 2rem;
            text-align: center;
            position: relative;
            border-bottom: 2px solid var(--tabacco);
        }

        .hero-loggato h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            letter-spacing: 3px;
            margin-bottom: 0.5rem;
        }

        .hero-loggato h1 span {
            color: var(--bronzo);
            text-shadow: 0 0 15px rgba(205, 127, 50, 0.3);
        }

        .hero-loggato p {
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            color: var(--cemento);
            letter-spacing: 1px;
        }

        /* ===== IMPAGINAZIONE DELLE SEZIONI CATALOGO ===== */
        .section {
            padding: 4.5rem 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            border-bottom: 1px solid rgba(30, 30, 30, 0.08);
            padding-bottom: 1rem;
            position: relative;
        }

        .section-header::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 80px;
            height: 3px;
            background: var(--bronzo);
        }

        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.2rem;
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
            font-weight: 600;
            transition: all 0.3s;
        }

        .section-link:hover {
            color: var(--tabacco);
            transform: translateX(4px);
        }

        .carousel-wrapper {
            position: relative;
        }

        .carousel {
            display: flex;
            gap: 2rem;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 1rem 0.5rem 2rem 0.5rem;
            scrollbar-width: none;
        }

        .carousel::-webkit-scrollbar {
            display: none;
        }

        .carousel-btn {
            position: absolute;
            top: 42%;
            transform: translateY(-50%);
            background: var(--ebano);
            color: var(--carta);
            border: 1px solid rgba(255, 255, 255, 0.1);
            width: 44px;
            height: 44px;
            border-radius: 50%;
            font-size: 1.3rem;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .carousel-btn:hover {
            background: var(--bronzo);
            color: var(--ebano);
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-btn.prev {
            left: -22px;
        }

        .carousel-btn.next {
            right: -22px;
        }

        /* ===== CARD LIBRO (OLOGRAFICA SCURA) ===== */
        .card-libro {
            min-width: 220px;
            max-width: 220px;
            background: rgba(30, 30, 30, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.04);
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            cursor: pointer;
            display: flex;
            flex-direction: column;
        }

        .card-libro:hover {
            transform: translateY(-10px);
            border-color: var(--bronzo);
            box-shadow: 0 15px 35px rgba(205, 127, 50, 0.25);
        }

        .card-cover {
            width: 100%;
            height: 260px;
            background: linear-gradient(135deg, var(--ebano), var(--tabacco));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            position: relative;
            overflow: hidden;
        }

        .card-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .card-libro:hover .card-cover img {
            transform: scale(1.06);
        }

        .card-body {
            padding: 14px 16px 18px;
            background: rgba(255, 255, 255, 0.01);
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .card-titolo {
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--carta);
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-autore {
            font-family: 'Inter', sans-serif;
            font-size: 0.78rem;
            color: var(--cemento);
            margin-bottom: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-prezzo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.3rem;
            color: var(--bronzo);
            letter-spacing: 1px;
            margin-top: auto;
        }

        .card-btn {
            display: block;
            width: 100%;
            margin-top: 12px;
            background: rgba(255, 255, 255, 0.04);
            color: var(--carta);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 4px;
            padding: 10px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .card-libro:hover .card-btn {
            background: var(--bronzo);
            color: var(--ebano);
            border-color: var(--bronzo);
            box-shadow: 0 4px 15px rgba(205, 127, 50, 0.4);
        }

        .empty-state {
            text-align: center;
            padding: 4rem;
            color: var(--cemento);
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            width: 100%;
        }

        /* ===== BANNER ===== */
        .banner {
            background: linear-gradient(135deg, var(--tabacco), var(--ebano) 70%);
            margin: 2rem;
            border-radius: 4px;
            padding: 4rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 3rem;
            flex-wrap: wrap;
            border-left: 4px solid var(--bronzo);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .banner-left h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(2.2rem, 5vw, 3.8rem);
            color: var(--carta);
            letter-spacing: 2px;
            line-height: 1.05;
            margin-bottom: 0.8rem;
        }

        .banner-left h2 span {
            color: var(--bronzo);
            text-shadow: 0 0 15px rgba(205, 127, 50, 0.3);
        }

        .banner-left p {
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            color: var(--cemento);
            max-width: 450px;
            line-height: 1.6;
        }

        .banner-emoji {
            font-size: 5.5rem;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.3));
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .hero {
                padding: 4rem 2rem 6rem 2rem;
                clip-path: none;
            }

            .hero-container {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 3rem;
            }

            .hero h1 {
                font-size: clamp(2.5rem, 7vw, 4.5rem);
            }

            .hero p {
                margin: 0 auto 2.5rem auto;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-visual {
                order: -1;
            }

            .banner {
                padding: 2.5rem;
                margin: 1rem;
            }
        }
    </style>
@endpush

@section('content')

    @auth
        {{-- ===== HOME UTENTE LOGGATO ===== --}}
        <div class="hero-loggato">
            <h1>Bentornato, <span>{{ Auth::user()->nome }}</span>!</h1>
            <p>Scopri le novità e i libri più amati del momento.</p>
        </div>

        {{-- Libri in Evidenza --}}
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">📚 Libri in Evidenza</h2>
                <a href="{{ route('catalogo') }}" class="section-link">Vedi tutti →</a>
            </div>
            <div class="carousel-wrapper">
                <button class="carousel-btn prev" onclick="scrollCarousel('evidenza', -1)">‹</button>
                <div class="carousel" id="evidenza">
                    @forelse($inEvidenza as $libro)
                        <div class="card-libro">
                            <a href="{{ route('libri.show', $libro->id_libro) }}"
                                style="text-decoration: none; color: inherit;">
                                <div class="card-cover">
                                    @if ($libro->copertina)
                                        <img src="{{ asset('storage/' . $libro->copertina) }}" alt="{{ $libro->titolo }}">
                                    @else
                                        📖
                                    @endif
                                </div>
                            </a>

                            <div class="card-body">
                                <a href="{{ route('libri.show', $libro->id_libro) }}"
                                    style="text-decoration: none; color: inherit;">
                                    <p class="card-titolo">{{ $libro->titolo }}</p>
                                    <p class="card-autore">{{ $libro->autore->nome ?? '' }} {{ $libro->autore->cognome ?? '' }}
                                    </p>
                                    <p class="card-prezzo">€ {{ number_format($libro->prezzo, 2, ',', '.') }}</p>
                                </a>

                                <form action="{{ route('carrello.add', $libro->id_libro) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="card-btn">+ Carrello</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">Nessun libro disponibile.</div>
                    @endforelse
                </div>
                <button class="carousel-btn next" onclick="scrollCarousel('evidenza', 1)">›</button>
            </div>
        </div>

        {{-- Più Venduti --}}
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">⭐ Più Venduti</h2>
                <a href="{{ route('catalogo') }}" class="section-link">Vedi tutti →</a>
            </div>
            <div class="carousel-wrapper">
                <button class="carousel-btn prev" onclick="scrollCarousel('venduti', -1)">‹</button>
                <div class="carousel" id="venduti">
                    @forelse($piuVenduti as $libro)
                        <div class="card-libro">
                            <a href="{{ route('libri.show', $libro->id_libro) }}"
                                style="text-decoration: none; color: inherit;">
                                <div class="card-cover">
                                    @if ($libro->copertina)
                                        <img src="{{ asset('storage/' . $libro->copertina) }}" alt="{{ $libro->titolo }}">
                                    @else
                                        ⭐
                                    @endif
                                </div>
                            </a>

                            <div class="card-body">
                                <a href="{{ route('libri.show', $libro->id_libro) }}"
                                    style="text-decoration: none; color: inherit;">
                                    <p class="card-titolo">{{ $libro->titolo }}</p>
                                    <p class="card-autore">{{ $libro->autore->nome ?? '' }}
                                        {{ $libro->autore->cognome ?? '' }}</p>
                                    <p class="card-prezzo">€ {{ number_format($libro->prezzo, 2, ',', '.') }}</p>
                                </a>

                                <form action="{{ route('carrello.add', $libro->id_libro) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="card-btn">+ Carrello</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">Nessun libro disponibile.</div>
                    @endforelse
                </div>
                <button class="carousel-btn next" onclick="scrollCarousel('venduti', 1)">›</button>
            </div>
        </div>

        {{-- Ultimi Arrivi --}}
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">🆕 Ultimi Arrivi</h2>
                <a href="{{ route('catalogo') }}" class="section-link">Vedi tutti →</a>
            </div>
            <div class="carousel-wrapper">
                <button class="carousel-btn prev" onclick="scrollCarousel('arrivi', -1)">‹</button>
                <div class="carousel" id="arrivi">
                    @forelse($ultimiArrivi as $libro)
                        <div class="card-libro">
                            <a href="{{ route('libri.show', $libro->id_libro) }}"
                                style="text-decoration: none; color: inherit;">
                                <div class="card-cover">
                                    @if ($libro->copertina)
                                        <img src="{{ asset('storage/' . $libro->copertina) }}" alt="{{ $libro->titolo }}">
                                    @else
                                        📗
                                    @endif
                                </div>
                            </a>

                            <div class="card-body">
                                <a href="{{ route('libri.show', $libro->id_libro) }}"
                                    style="text-decoration: none; color: inherit;">
                                    <p class="card-titolo">{{ $libro->titolo }}</p>
                                    <p class="card-autore">{{ $libro->autore->nome ?? '' }}
                                        {{ $libro->autore->cognome ?? '' }}</p>
                                    <p class="card-prezzo">€ {{ number_format($libro->prezzo, 2, ',', '.') }}</p>
                                </a>

                                <form action="{{ route('carrello.add', $libro->id_libro) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="card-btn">+ Carrello</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">Nessun libro disponibile.</div>
                    @endforelse
                </div>
                <button class="carousel-btn next" onclick="scrollCarousel('arrivi', 1)">›</button>
            </div>
        </div>
    @else
        {{-- ===== HOME UTENTE NON LOGGATO ===== --}}
        <section class="hero">
            <div class="hero-container">
                <div class="hero-content">
                    <p class="hero-tag">The Online Bookspace</p>
                    <h1>Il tuo prossimo <span>libro</span><br>ti sta aspettando</h1>
                    <p>Scopri migliaia di titoli, dai classici ai nuovi arrivi. Ordina comodamente da casa.</p>
                    <div class="hero-buttons">
                        <a href="{{ route('register') }}" class="btn-primary">Registrati gratis</a>
                        <a href="{{ route('login') }}" class="btn-secondary">Accedi</a>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="hero-graphic-element">📖</div>
                </div>
            </div>
        </section>

        <div class="banner">
            <div class="banner-left">
                <h2>Spedizione <span>gratuita</span><br>sopra i 25€</h2>
                <p>Ordina adesso e ricevi i tuoi libri direttamente a casa tua in pochi giorni.</p>
            </div>
            <div class="banner-emoji">🚚</div>
        </div>
    @endauth

@endsection

@push('scripts')
    <script>
        function scrollCarousel(id, direction) {
            const carousel = document.getElementById(id);
            carousel.scrollBy({
                left: direction * 500,
                behavior: 'smooth'
            });
        }
    </script>
@endpush
