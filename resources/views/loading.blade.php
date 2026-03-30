@extends('layouts.app')

@section('title', 'Benvenuto su Librooz')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;600&display=swap');

    body { background-color: var(--carta) !important; overflow: hidden; }
    .navbar, footer { display: none !important; }

    .loading-page {
        display: flex;
        height: 100vh;
        width: 100vw;
    }

    /* ===== SINISTRA ===== */
    .left-panel {
        width: 45%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 3rem 3.5rem;
        background-color: var(--carta);
    }

    .left-top {
        font-family: 'Inter', sans-serif;
        font-size: 0.8rem;
        letter-spacing: 4px;
        color: var(--ebano);
        text-transform: uppercase;
        opacity: 0;
        animation: fadeIn 0.8s ease forwards 0.3s;
    }

    .left-center {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .left-logo {
        font-family: 'Bebas Neue', sans-serif;
        font-size: clamp(5rem, 12vw, 9rem);
        color: var(--ebano);
        line-height: 1;
        letter-spacing: 2px;
        opacity: 0;
        animation: fadeInUp 1s ease forwards 0.5s;
    }

    .left-logo span { color: var(--tabacco); }

    /* ===== PROGRESS BAR SINISTRA ===== */
    .progress-wrapper {
        width: 100%;
        opacity: 0;
        animation: fadeIn 0.8s ease forwards 1s;
    }

    .progress-label {
        font-family: 'Inter', sans-serif;
        font-size: 0.7rem;
        letter-spacing: 3px;
        color: var(--cemento);
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .progress-bar {
        height: 3px;
        background: rgba(0,0,0,0.1);
        border-radius: 2px;
        overflow: hidden;
        width: 100%;
    }

    .progress-fill {
        height: 100%;
        background: var(--bronzo);
        width: 0%;
        animation: fill 5s ease-in-out forwards 1.2s;
        border-radius: 2px;
    }

    .progress-percent {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1rem;
        color: var(--bronzo);
        margin-top: 6px;
        letter-spacing: 2px;
    }

    @keyframes fill {
        0%   { width: 0%; }
        100% { width: 100%; }
    }

    .left-bottom {
        font-family: 'Inter', sans-serif;
        font-size: 0.8rem;
        letter-spacing: 4px;
        color: var(--cemento);
        text-transform: uppercase;
        opacity: 0;
        animation: fadeIn 0.8s ease forwards 1s;
    }

    /* ===== DESTRA ===== */
    .right-panel {
        width: 55%;
        background-color: var(--ebano);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Testo sfondo */
    .bg-text {
        position: absolute;
        font-family: 'Bebas Neue', sans-serif;
        font-size: clamp(4rem, 10vw, 8rem);
        color: rgba(255,255,255,0.04);
        white-space: nowrap;
        user-select: none;
        pointer-events: none;
        letter-spacing: 4px;
    }

    .bg-text-1 { top: 5%;  left: -5%; }
    .bg-text-2 { top: 25%; right: -5%; }
    .bg-text-3 { top: 45%; left: -5%; }
    .bg-text-4 { top: 65%; right: -5%; }
    .bg-text-5 { top: 82%; left: -5%; }

    /* ===== IMMAGINI ===== */
    .book-img {
        position: absolute;
        width: 200px;
        border-radius: 12px;
        box-shadow: 0 25px 60px rgba(0,0,0,0.6);
        opacity: 0;
    }

    /* Immagine 1 — scende dall'alto */
    .img-1 {
        top: 6%;
        left: 12%;
        transform: rotate(-5deg) translateY(-120%);
        animation: slideDown 1.2s cubic-bezier(0.34, 1.4, 0.64, 1) forwards 0.6s;
    }

    /* Immagine 2 — sale dal basso */
    .img-2 {
        bottom: 6%;
        right: 8%;
        transform: rotate(4deg) translateY(120%);
        animation: slideUp 1.2s cubic-bezier(0.34, 1.4, 0.64, 1) forwards 1.1s;
    }

    @keyframes slideDown {
        0%   { opacity: 0; transform: rotate(-5deg) translateY(-120%); }
        100% { opacity: 1; transform: rotate(-5deg) translateY(0); }
    }

    @keyframes slideUp {
        0%   { opacity: 0; transform: rotate(4deg) translateY(120%); }
        100% { opacity: 1; transform: rotate(4deg) translateY(0); }
    }

    /* ===== ANIMAZIONI GENERALI ===== */
    @keyframes fadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')
<div class="loading-page">

    {{-- SINISTRA --}}
    <div class="left-panel">
        <p class="left-top">Elegance & Knowledge</p>

        <div class="left-center">
            <h1 class="left-logo">Li<span>B</span>ROO<span>Z</span></h1>

            <div class="progress-wrapper">
                <p class="progress-label">Caricamento in corso</p>
                <div class="progress-bar">
                    <div class="progress-fill" id="progressFill"></div>
                </div>
                <p class="progress-percent" id="progressPercent">0%</p>
            </div>
        </div>

        <p class="left-bottom">The Online Bookspace</p>
    </div>

    {{-- DESTRA --}}
    <div class="right-panel">

        {{-- Testo sfondo --}}
        <p class="bg-text bg-text-1">STORIE SENZA TEMPO</p>
        <p class="bg-text bg-text-2">SVELARE IL PASSATO</p>
        <p class="bg-text bg-text-3">STORIE SENZA TEMPO</p>
        <p class="bg-text bg-text-4">SVELARE IL PASSATO</p>
        <p class="bg-text bg-text-5">STORIE SENZA TEMPO</p>

        {{-- Immagine 1 (scende dall'alto) --}}
        <img
            class="book-img img-1"
            src="https://covers.openlibrary.org/b/id/8739161-L.jpg"
            alt="Libro 1"
        >

        {{-- Immagine 2 (sale dal basso) --}}
        <img
            class="book-img img-2"
            src="https://covers.openlibrary.org/b/id/7984916-L.jpg"
            alt="Libro 2"
        >

    </div>
</div>
@endsection

@push('scripts')
<script>
    // Contatore percentuale
    let percent = 0;
    const total = 5000; // 5 secondi
    const interval = 50;
    const steps = total / interval;
    const increment = 100 / steps;
    const label = document.getElementById('progressPercent');

    const counter = setInterval(() => {
        percent = Math.min(100, percent + increment);
        label.textContent = Math.floor(percent) + '%';
        if (percent >= 100) clearInterval(counter);
    }, interval);

    // Redirect dopo 5 secondi
    setTimeout(() => {
        window.location.href = "{{ route('home') }}";
    }, 5200);
</script>
@endpush