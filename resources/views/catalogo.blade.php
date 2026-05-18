@extends('layouts.app')

@section('content')
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <style>
        /* ===== RESET E SETUP SFONDO ===== */
        body {
            background: #0a0a0a !important;
            color: #f8fafc;
            font-family: 'Poppins', sans-serif;
        }

        .catalogo-titolo {
            font-family: 'Playfair Display', serif;
            color: #c5a059;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        /* ===== BARRA DI FILTRAGGIO ===== */
        .filter-bar {
            background: #121212;
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 1.25rem;
            margin-bottom: 3.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5) !important;
        }

        .form-select-custom {
            background: #1a1a1a !important;
            border: 1px solid #2d2d2d !important;
            color: #fff !important;
            border-radius: 10px !important;
            padding: 0.6rem 1rem !important;
            font-size: 0.95rem;
            color-scheme: dark;
            transition: border-color 0.2s ease;
        }

        .form-select-custom:focus {
            border-color: #c5a059 !important;
            box-shadow: 0 0 0 3px rgba(197, 160, 89, 0.15) !important;
        }

        .btn-filter {
            background: #c5a059;
            color: #0a0a0a;
            font-weight: 600;
            border: none;
            border-radius: 10px !important;
            padding: 0.6rem 1.5rem !important;
        }

        /* ===== STRUTTURA DELLE CARD ===== */
        .libro-card {
            background: #131313;
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .libro-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(197, 160, 89, 0.15);
            border-color: rgba(197, 160, 89, 0.4);
        }

        .copertina-wrap {
            height: 320px;
            background: #1a1a1a;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .copertina-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .libro-card:hover .copertina-img {
            transform: scale(1.05);
        }

        .placeholder-img {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            color: #333;
            background: #161616;
            width: 100%;
        }

        /* Tasto Wishlist Rapido rosso/grigio */
        .wishlist-quick-form {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 10;
        }

        .btn-quick-wishlist {
            background: rgba(20, 20, 20, 0.75);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.2s ease, background-color 0.2s ease, filter 0.2s ease;
            font-size: 0.95rem;
            filter: grayscale(1);
            /* Spento (grigio) di base */
        }

        .btn-quick-wishlist:hover {
            transform: scale(1.15);
            background: #ffffff;
        }

        .btn-quick-wishlist.active {
            filter: grayscale(0) !important;
        }

        /* Torna rosso quando attivo */

        /* CORPO INFORMATIVO */
        .libro-corpo {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .libro-titolo {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            font-size: 1.1rem;
            line-height: 1.4;
            color: #ffffff;
            margin-bottom: 0.25rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 3rem;
        }

        .libro-autore {
            font-size: 0.85rem;
            color: #cbd5e1;
            font-weight: 400;
            margin-bottom: 1.25rem;
        }

        .libro-meta-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-bottom: 1rem;
        }

        .libro-prezzo {
            color: #c5a059;
            font-weight: 600;
            font-size: 1.25rem;
        }

        .btn-quick-cart {
            background: rgba(197, 160, 89, 0.1);
            border: 1px solid rgba(197, 160, 89, 0.3);
            color: #c5a059;
            width: 38px;
            height: 38px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-quick-cart:hover {
            background: #c5a059;
            color: #0a0a0a;
            transform: scale(1.05);
        }

        .btn-scopri {
            width: 100%;
            text-align: center;
            border-radius: 8px !important;
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.6rem 1rem !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            color: #ffffff !important;
            background: transparent;
            text-decoration: none;
            transition: all 0.2s ease;
            display: block;
        }

        .btn-scopri:hover {
            background: #ffffff !important;
            color: #0a0a0a !important;
            border-color: #ffffff !important;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.15);
        }

        /* ===== SISTEMA NOTIFICHE TOAST ===== */
        .toast-container {
            position: fixed;
            top: 90px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .custom-toast {
            background: #161616;
            color: #ffffff;
            border-left: 4px solid #c5a059;
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.9rem;
            font-weight: 500;
            min-width: 280px;
            transform: translateX(120%);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .custom-toast.show {
            transform: translateX(0);
        }

        .custom-toast.toast-wishlist {
            border-left-color: #e74c3c;
        }

        .custom-toast.toast-cart {
            border-left-color: #27ae60;
        }
    </style>

    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="catalogo-titolo">La Nostra Collezione</h1>
            <p class="text-muted small mb-0" style="letter-spacing: 1.5px; text-transform: uppercase;">Esplora i nostri volumi
                esclusivi</p>
        </div>

        <div class="filter-bar">
            <form action="{{ route('catalogo') }}" method="GET" class="row g-3 align-items-center justify-content-center">
                <div class="col-md-5 col-sm-8">
                    <select name="categoria" class="form-select form-select-custom">
                        <option value="">Tutte le categorieeeeeeeeeeeeeeee</option>
                        @foreach ($categorie as $cat)
                            <option value="{{ $cat->id_categoria }}"
                                {{ request('categoria') == $cat->id_categoria ? 'selected' : '' }}>
                                {{ $cat->nome_categoria ?? $cat->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 col-sm-4">
                    <button type="submit" class="btn btn-filter w-100">Filtra</button>
                </div>
            </form>
        </div>

        <div class="row g-4">
            @forelse($libri as $l)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="libro-card">

                        <div class="copertina-wrap">
                            <form action="{{ route('wishlist.toggle') }}" method="POST"
                                class="wishlist-quick-form ajax-form-wishlist">
                                @csrf
                                <input type="hidden" name="id_libro" value="{{ $l->id_libro ?? $l->id }}">

                                @php
                                    $inWishlist = isset($wishlistIds) && in_array($l->id_libro ?? $l->id, $wishlistIds);
                                @endphp

                                <button type="submit" class="btn-quick-wishlist {{ $inWishlist ? 'active' : '' }}"
                                    title="Aggiungi/Rimuovi Wishlist">❤️</button>
                            </form>

                            @if ($l->copertina)
                                <img src="{{ asset('storage/' . $l->copertina) }}" class="copertina-img"
                                    alt="{{ $l->titolo }}">
                            @else
                                <div class="placeholder-img">📖</div>
                            @endif
                        </div>

                        <div class="libro-corpo">
                            <div>
                                <h3 class="libro-titolo" title="{{ $l->titolo }}">{{ $l->titolo }}</h3>
                                <p class="libro-autore">
                                    {{ $l->autore->nome ?? '' }} {{ $l->autore->cognome ?? '' }}
                                </p>
                            </div>

                            <div class="libro-meta-row">
                                <span class="libro-prezzo">€ {{ number_format($l->prezzo, 2, ',', '.') }}</span>

                                <form action="{{ route('carrello.add', $l->id_libro ?? $l->id) }}" method="POST"
                                    class="m-0 ajax-form-cart">
                                    @csrf
                                    <button type="submit" class="btn-quick-cart" title="Aggiungi al carrello">🛒</button>
                                </form>
                            </div>

                            <a href="{{ route('libri.show', $l->id_libro ?? $l->id) }}" class="btn-scopri">Scopri di
                                più</a>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🔍</div>
                    <h4 class="text-white">Nessun libro trovato</h4>
                </div>
            @endforelse
        </div>
    </div>

    <div class="toast-container" id="toastContainer"></div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function showToast(message, type = 'info') {
                const container = document.getElementById('toastContainer');
                const toast = document.createElement('div');
                toast.classList.add('custom-toast');

                if (type === 'wishlist') {
                    toast.classList.add('toast-wishlist');
                    toast.innerHTML = `<span>❤️</span> ${message}`;
                } else if (type === 'cart') {
                    toast.classList.add('toast-cart');
                    toast.innerHTML = `<span>🛒</span> ${message}`;
                } else {
                    toast.innerHTML = `<span>ℹ️</span> ${message}`;
                }

                container.appendChild(toast);
                setTimeout(() => toast.classList.add('show'), 50);

                setTimeout(() => {
                    toast.classList.remove('show');
                    setTimeout(() => toast.remove(), 400);
                }, 3500);
            }

            // CARRELLO RAPIDO AJAX VIA FETCH
            document.querySelectorAll('.ajax-form-cart').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const url = this.action;
                    const formData = new FormData(this);

                    fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => {
                            // Fallback se il carrello esegue una risposta mista o JSON
                            showToast(
                                'Splendida scelta! Il volume è stato aggiunto al carrello.',
                                'cart');
                        })
                        .catch(() => showToast(
                                'Splendida scelta! Il volume è stato aggiunto al carrello.', 'cart'
                                ));
                });
            });

            // WISHLIST RAPIDA AJAX VIA FETCH
            document.querySelectorAll('.ajax-form-wishlist').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const url = this.action;
                    const formData = new FormData(this);
                    const button = this.querySelector('.btn-quick-wishlist');

                    fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.status === 'aggiunto') {
                                button.classList.add('active');
                                showToast(data.message, 'wishlist');
                            } else if (data && data.status === 'rimosso') {
                                button.classList.remove('active');
                                showToast(data.message, 'wishlist');
                            }
                        })
                        .catch(() => {
                            button.classList.toggle('active');
                            showToast('Stato preferiti aggiornato', 'wishlist');
                        });
                });
            });
        });
    </script>
@endpush
