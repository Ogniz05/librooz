@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: #090a0f !important;
            color: #f8fafc;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* ===== BANNER IMMERSIVO MODIFICABILE ===== */
        .fullscreen-banner {
            height: 380px;
            background-size: cover;
            background-position: center;
            position: relative;
            width: 100%;
            cursor: pointer;
            box-shadow: inset 0 -100px 100px #090a0f;
        }

        .banner-upload-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .fullscreen-banner:hover .banner-upload-overlay {
            opacity: 1;
        }

        .upload-text {
            background: rgba(11, 12, 17, 0.85);
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(6px);
        }

        /* ===== CONTENITORE CENTRALE ===== */
        .profile-content-container {
            max-width: 850px;
            margin: 0 auto;
            padding: 0 24px 60px 24px;
            position: relative;
        }

        /* ===== AVATAR PROFILO MODIFICABILE ===== */
        .profile-avatar-wrapper {
            margin-top: -90px;
            margin-bottom: 32px;
            position: relative;
            display: inline-block;
            z-index: 5;
            cursor: pointer;
        }

        .profile-main-avatar {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            border: 6px solid #090a0f;
            background-size: cover;
            background-position: center;
            background-color: #1d202b;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            font-weight: 700;
            color: #ffffff;
        }

        .avatar-upload-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.75);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            opacity: 0;
            transition: opacity 0.2s ease;
            font-size: 0.75rem;
            text-align: center;
            padding: 10px;
            box-sizing: border-box;
            color: #ffffff;
        }

        .profile-avatar-wrapper:hover .avatar-upload-overlay {
            opacity: 1;
        }

        .hidden-file-input {
            display: none;
        }

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
            z-index: 6;
        }

        /* ===== GRID E SEZIONI ===== */
        .profile-main-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
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

        .profile-textarea-field {
            min-height: 100px;
            resize: vertical;
        }

        /* ===== COLLEGAMENTI LATERALI ===== */
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

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        @php
            $defaultBanner =
                'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=1500&auto=format&fit=crop';
            $defaultAvatar =
                'https://images.unsplash.com/photo-1620641788421-7a1c342ea42e?q=80&w=400&auto=format&fit=crop';
        @endphp

        <div id="banner-preview" class="fullscreen-banner"
            style="background-image: url('{{ $user->banner_path ? asset('storage/' . $user->banner_path) : $defaultBanner }}');"
            onclick="document.getElementById('banner-input').click();"
            title="Dimensioni consigliate banner: 1500 x 500 pixel">
            <div class="banner-upload-overlay">
                <span class="upload-text">📸 Cambia Banner (Consigliato: 1500x500px)</span>
            </div>
        </div>
        <input type="file" id="banner-input" name="banner" class="hidden-file-input" accept="image/*">

        <div class="profile-content-container">

            <div class="profile-avatar-wrapper" onclick="document.getElementById('avatar-input').click();">
                <div id="avatar-preview" class="profile-main-avatar"
                    style="@if ($user->avatar_path) background-image: url('{{ asset('storage/' . $user->avatar_path) }}'); @endif">
                    @if (!$user->avatar_path)
                        {{ strtoupper(substr($user->nome ?? Auth::user()->name, 0, 1)) }}
                    @endif
                    <div class="avatar-upload-overlay">
                        <span>📷<br>Cambia foto<br>(400x400px)</span>
                    </div>
                </div>
                <div class="profile-verified-badge">✓</div>
            </div>
            <input type="file" id="avatar-input" name="avatar" class="hidden-file-input" accept="image/*">

            @if (session('status') === 'profile-updated' || session('success'))
                <div class="alert-success-minimal">
                    ✨ Le informazioni del profilo sono state aggiornate con successo.
                </div>
            @endif

            <div class="profile-main-grid">
                <div>
                    <div class="profile-section-card">
                        <div class="profile-section-title">Informazioni di base</div>

                        <div class="profile-info-group">
                            <label for="name">Nome utente</label>
                            <input type="text" id="name" name="name" class="profile-input-field"
                                value="{{ old('name', $user->nome ?? Auth::user()->name) }}" required autocomplete="name">
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
                                value="{{ old('address', $user->via ?? '') }}" placeholder="Nessun indirizzo salvato"
                                autocomplete="street-address">
                        </div>
                    </div>

                    <div class="profile-section-card">
                        <div class="profile-section-title">About me</div>
                        <div class="profile-info-group" style="margin-bottom: 0;">
                            <label for="bio">Biografia del lettore</label>
                            <textarea id="bio" name="bio" class="profile-input-field profile-textarea-field"
                                placeholder="Raccontaci qualcosa sui tuoi generi letterari preferiti o sul tuo percorso di lettura...">{{ old('bio', $user->bio ?? '') }}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn-profile-submit-dark">Salva tutte le modifiche</button>
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
                                <span class="shortcut-desc">{{ session('wishlist') ? count(session('wishlist')) : 0 }}
                                    libri salvati</span>
                            </div>
                        </div>
                        <div class="shortcut-arrow">&rarr;</div>
                    </a>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const avatarInput = document.getElementById('avatar-input');
            const avatarPreview = document.getElementById('avatar-preview');
            const bannerInput = document.getElementById('banner-input');
            const bannerPreview = document.getElementById('banner-preview');

            if (avatarInput && avatarPreview) {
                avatarInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            avatarPreview.style.backgroundImage = `url('${e.target.result}')`;
                            if (avatarPreview.innerText) avatarPreview.innerText = '';
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }

            if (bannerInput && bannerPreview) {
                bannerInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            bannerPreview.style.backgroundImage = `url('${e.target.result}')`;
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }

            const navbarBadge = document.getElementById('cart-count') || document.querySelector('.badge') ||
                document.querySelector('header span');
            const profileCount = document.getElementById('profile-cart-count');
            if (navbarBadge && profileCount) {
                const countValue = navbarBadge.textContent.trim().replace(/[^0-9]/g, '');
                if (countValue) profileCount.textContent = countValue;
            }
        });
    </script>
@endsection
