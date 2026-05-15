@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: #090a0f !important;
            /* Sfondo scuro e immersivo */
            color: #f8fafc;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* ===== BANNER IMMERSIVO A TUTTA LARGHEZZA ===== */
        .fullscreen-banner {
            height: 380px;
            /* Banner imponente che prende quasi tutta la prima parte dello schermo */
            background: linear-gradient(135deg, #1f212a 0%, #2c2f3d 50%, #111217 100%);
            background-size: cover;
            background-position: center;
            position: relative;
            width: 100%;
        }

        /* ===== CONTENITORE CENTRALE DEL PROFILO ===== */
        .profile-content-container {
            max-width: 850px;
            margin: 0 auto;
            padding: 0 24px 60px 24px;
            position: relative;
        }

        /* ===== AVATAR PROFILO GRANDE IN SOVRAPPOSIZIONE ===== */
        .profile-avatar-wrapper {
            margin-top: -90px;
            /* Spinge l'avatar verso l'alto sul banner */
            margin-bottom: 32px;
            position: relative;
            display: inline-block;
            z-index: 5;
        }

        .profile-main-avatar {
            width: 160px;
            /* Dimensione aumentata per dare importanza all'immagine */
            height: 160px;
            border-radius: 50%;
            border: 6px solid #090a0f;
            /* Contorno spesso per staccarsi dallo sfondo */
            background: #1d202b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            font-weight: 700;
            color: #ffffff;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
        }

        /* Badge di verifica Premium */
        .profile-verified-badge {
            position: absolute;
            bottom: 8px;
            right: 8px;
            background: #1d9bf0;
            color: white;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            border: 3px solid #090a0f;
        }

        /* ===== SEZIONI PRINCIPALI (LAYOUT PULITO) ===== */
        .profile-main-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            /* 2 Terzi per informazioni/about, 1 terzo per i collegamenti */
            gap: 32px;
        }

        @media (max-width: 768px) {
            .profile-main-grid {
                grid-template-columns: 1fr;
            }
        }

        .profile-section-card {
            background: #111217;
            border: 1px solid rgba(255, 255, 255, 0.04);
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            margin-bottom: 24px;
        }

        .profile-section-title {
            font-size: 1.15rem;
            font-weight: 600;
            color: #ffffff;
            margin-top: 0;
            margin-bottom: 24px;
            letter-spacing: -0.3px;
        }

        /* ===== STRUTTURA DETTAGLI E FORM ===== */
        .profile-info-group {
            margin-bottom: 20px;
        }

        .profile-info-group label {
            display: block;
            font-size: 0.85rem;
            color: #62677b;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .profile-input-field {
            width: 100%;
            background: #16181f !important;
            border: 1px solid #242731 !important;
            color: #ffffff !important;
            border-radius: 14px !important;
            padding: 14px 16px !important;
            font-size: 0.95rem;
            outline: none;
            box-sizing: border-box;
            transition: border-color 0.2s;
        }

        .profile-input-field:focus {
            border-color: #4a5168 !important;
        }

        .profile-textarea-field {
            min-height: 100px;
            resize: vertical;
        }

        /* ===== PULSANTI DI NAVIGAZIONE RAPIDA (CARRELLO / WISHLIST) ===== */
        .shortcut-navigation-box {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .btn-profile-shortcut {
            background: #111217;
            border: 1px solid rgba(255, 255, 255, 0.04);
            border-radius: 20px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #ffffff;
            text-decoration: none;
            transition: transform 0.2s, background 0.2s, border-color 0.2s;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .btn-profile-shortcut:hover {
            transform: translateY(-3px);
            background: #16181f;
            border-color: rgba(255, 255, 255, 0.1);
        }

        .shortcut-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .shortcut-icon {
            font-size: 1.5rem;
        }

        .shortcut-info {
            display: flex;
            flex-direction: column;
        }

        .shortcut-title {
            font-weight: 600;
            font-size: 0.95rem;
        }

        .shortcut-desc {
            font-size: 0.8rem;
            color: #62677b;
            margin-top: 2px;
        }

        .shortcut-arrow {
            color: #4a5168;
            font-size: 1rem;
        }

        /* ===== PULSANTI DI SALVATAGGIO ===== */
        .btn-profile-submit-dark {
            background: #ffffff;
            color: #090a0f;
            border: none;
            border-radius: 14px;
            padding: 14px 28px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: opacity 0.2s;
            width: 100%;
            margin-top: 12px;
        }

        .btn-profile-submit-dark:hover {
            opacity: 0.9;
        }

        .alert-success-minimal {
            background: rgba(46, 204, 113, 0.1);
            border: 1px solid rgba(46, 204, 113, 0.2);
            color: #2ecc71;
            padding: 16px;
            border-radius: 16px;
            margin-bottom: 24px;
            font-size: 0.9rem;
        }
    </style>

    <div class="fullscreen-banner"></div>

    <div class="profile-content-container">

        <div class="profile-avatar-wrapper">
            <div class="profile-main-avatar">
                {{ strtoupper(substr($user->name ?? Auth::user()->name, 0, 1)) }}
            </div>
            <div class="profile-verified-badge">✓</div>
        </div>

        @if (session('status') === 'profile-updated' || session('success'))
            <div class="alert-success-minimal">
                ✨ Le informazioni del profilo sono state aggiornate.
            </div>
        @endif

        <div class="profile-main-grid">

            <div>
                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="profile-section-card">
                        <div class="profile-section-title">Informazioni di base</div>

                        <div class="profile-info-group">
                            <label for="name">Nome utente</label>
                            <input type="text" id="name" name="name" class="profile-input-field"
                                value="{{ old('name', $user->name ?? Auth::user()->name) }}" required autocomplete="name">
                        </div>

                        <div class="profile-info-group">
                            <label for="email">Indirizzo Email</label>
                            <input type="email" id="email" name="email" class="profile-input-field"
                                value="{{ old('email', $user->email ?? Auth::user()->email) }}" required
                                autocomplete="username">
                        </div>

                        <div class="profile-info-group">
                            <label for="address">Indirizzo di Spedizione</label>
                            <input type="text" id="address" name="address" class="profile-input-field"
                                value="{{ old('address', $user->address ?? 'Nessun indirizzo salvato') }}"
                                autocomplete="street-address">
                        </div>
                    </div>

                    <div class="profile-section-card">
                        <div class="profile-section-title">About me</div>
                        <div class="profile-info-group" style="margin-bottom: 0;">
                            <label for="bio">Biografia del lettore</label>
                            <textarea id="bio" name="bio" class="profile-input-field profile-textarea-field"
                                placeholder="Raccontaci qualcosa sui tuoi generi letterari preferiti o sul tuo percorso di lettura..."></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn-profile-submit-dark">Salva tutte le modifiche</button>
                </form>
            </div>

            <div class="shortcut-navigation-box">

                <a href="{{ route('carrello.index') }}" class="btn-profile-shortcut">
                    <div class="shortcut-left">
                        <span class="shortcut-icon">🛒</span>
                        <div class="shortcut-info">
                            <span class="shortcut-title">Il mio Carrello</span>
                            <span class="shortcut-desc">
                                <span id="profile-cart-count">0</span> articoli in attesa
                            </span>
                        </div>
                    </div>
                    <div class="shortcut-arrow">&rarr;</div>
                </a>

                <a href="{{ route('wishlist.index') }}" class="btn-profile-shortcut">
                    <div class="shortcut-left">
                        <span class="shortcut-icon">❤️</span>
                        <div class="shortcut-info">
                            <span class="shortcut-title">Lista dei Desideri</span>
                            <span class="shortcut-desc">{{ session('wishlist') ? count(session('wishlist')) : 0 }} libri
                                salvati</span>
                        </div>
                    </div>
                    <div class="shortcut-arrow">&rarr;</div>
                </a>

            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Isoliamo la barra di navigazione superiore
            const header = document.querySelector('header') || document.querySelector('nav') || document.body;

            // 2. Troviamo TUTTI i badge o elementi numerici presenti nell'header
            // Cerchiamo i contenitori fluttuanti che di solito hanno classi per lo sfondo colorato (rosso/verde)
            const badges = header.querySelectorAll('span, div, b, strong');
            let foundNumbers = [];

            badges.forEach(badge => {
                const text = badge.textContent.trim();
                // Se l'elemento contiene solo un numero ed è visibile a schermo
                if (text && !isNaN(text) && badge.offsetHeight > 0) {
                    foundNumbers.push({
                        element: badge,
                        value: parseInt(text, 10),
                        // Prendiamo la posizione orizzontale sullo schermo
                        rectLeft: badge.getBoundingClientRect().left
                    });
                }
            });

            // 3. Ordiniamo i numeri trovati da sinistra a destra basandoci sulla loro posizione X sulla pagina
            foundNumbers.sort((a, b) => a.rectLeft - b.rectLeft);

            let cartCountValue = 0;

            if (foundNumbers.length >= 2) {
                // Se ci sono almeno due contatori (Wishlist e Carrello):
                // In base al tuo screenshot, il Carrello è l'ultimo elemento a destra in assoluto!
                cartCountValue = foundNumbers[foundNumbers.length - 1].value;
            } else if (foundNumbers.length === 1) {
                // Se ne trova solo uno, usiamo quello
                cartCountValue = foundNumbers[0].value;
            } else {
                // Fallback estremo se i badge grafici non sono leggibili: proviamo a cercare nel LocalStorage del browser
                const localCart = localStorage.getItem('cart') || localStorage.getItem('carrello') || localStorage
                    .getItem('shopping_cart');
                if (localCart) {
                    try {
                        const parsedCart = JSON.parse(localCart);
                        cartCountValue = parsedCart.length || Object.keys(parsedCart).length || parsedCart;
                    } catch (e) {
                        cartCountValue = localCart.replace(/[^0-9]/g, '');
                    }
                }
            }

            // 4. Scriviamo il valore finale nel contatore del profilo
            const profileCartCount = document.getElementById('profile-cart-count');
            if (profileCartCount && cartCountValue !== undefined) {
                profileCartCount.textContent = cartCountValue;
            }
        });
    </script>
@endsection
