<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librooz — @yield('title', 'Il tuo negozio di libri')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @stack('styles')
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="navbar-logo">
            <span class="icon">📚</span>
            <span class="brand">Librooz</span>
        </a>

        {{-- Hamburger (mobile) --}}
        <button class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </button>

        {{-- Voci centrali --}}
        <ul class="navbar-links" id="navbar-links">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li>
                @auth
                    <a href="{{ route('catalogo') }}" class="{{ request()->routeIs('catalogo') ? 'active' : '' }}">Catalogo</a>
                @else
                    <a href="#" onclick="openPopup()">Catalogo</a>
                @endauth
            </li>
        </ul>

        {{-- Destra --}}
        <div class="navbar-right">
            @auth
                <div class="user-menu">
                    <button class="user-btn" onclick="toggleUserMenu()">
                        👤 {{ Auth::user()->nome }} ▾
                    </button>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="{{ route('profile.index') }}">Il mio profilo</a>
                        <a href="{{ route('orders.index') }}">I miei ordini</a>
                        @if(Auth::user()->isAdmin())
                            <a href="/admin/dashboard" class="admin-link">🔧 Pannello Admin</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Esci</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-accedi">Accedi</a>
                <a href="{{ route('register') }}" class="btn-registrati">Registrati</a>
            @endauth

            <a href="{{ route('carrello.index') }}" class="btn-carrello">
                🛒
                @if(session('cart') && count(session('cart')) > 0)
                    <span class="badge-carrello">{{ count(session('cart')) }}</span>
                @endif
            </a>
        </div>

    </nav>

    {{-- CONTENUTO PAGINA --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer>
        <div class="footer-top">

            {{-- Brand --}}
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="brand-logo">📚 Librooz</a>
                <p>Il tuo spazio online dedicato ai libri. Scopri migliaia di titoli, dai classici ai nuovi arrivi, e ordinali comodamente da casa.</p>
                <div class="footer-social">
                    <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" title="TikTok"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>

            {{-- Account --}}
            <div class="footer-col">
                <h4>Account</h4>
                <ul>
                    @auth
                        <li><a href="{{ route('orders.index') }}">→ I miei ordini</a></li>
                        <li><a href="{{ route('profile.index') }}">→ Il mio profilo</a></li>
                    @else
                        <li><a href="{{ route('login') }}">→ Accedi</a></li>
                        <li><a href="{{ route('register') }}">→ Registrati</a></li>
                    @endauth
                </ul>
            </div>

            {{-- Informazioni --}}
            <div class="footer-col">
                <h4>Informazioni</h4>
                <ul>
                    <li><a href="#">→ Chi siamo</a></li>
                    <li><a href="#">→ Come funziona</a></li>
                    <li><a href="#">→ Spedizioni</a></li>
                    <li><a href="#">→ Resi e rimborsi</a></li>
                    <li><a href="#">→ FAQ</a></li>
                </ul>
            </div>

            {{-- Newsletter --}}
            <div class="footer-col">
                <h4>Newsletter</h4>
                <div class="footer-newsletter">
                    <p>Iscriviti e ricevi ogni settimana le novità, le offerte esclusive e i consigli di lettura.</p>
                    <div class="newsletter-form">
                        <input type="email" placeholder="La tua email">
                        <button type="button">→</button>
                    </div>
                </div>
            </div>

        </div>

        <hr class="footer-divider">

        <div class="footer-bottom">
            <div class="footer-bottom-left">
                © {{ date('Y') }} <span>Librooz</span> — Tutti i diritti riservati
            </div>
            <div class="footer-bottom-right">
                <a href="#">Privacy Policy</a>
                <a href="#">Termini di servizio</a>
                <a href="#">Cookie</a>
            </div>
        </div>
    </footer>

    {{-- SCRIPTS --}}
    <script>
        const hamburger = document.getElementById('hamburger');
        const navLinks  = document.getElementById('navbar-links');

        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('open');
            navLinks.classList.toggle('open');
        });

        function toggleUserMenu() {
            document.getElementById('userDropdown').classList.toggle('open');
        }

        document.addEventListener('click', function(e) {
            const menu = document.getElementById('userDropdown');
            if (menu && !e.target.closest('.user-menu')) {
                menu.classList.remove('open');
            }
        });

        function openPopup() {
            document.getElementById('popupLogin').classList.add('open');
            document.getElementById('overlay').classList.add('open');
        }

        function closePopup() {
            document.getElementById('popupLogin').classList.remove('open');
            document.getElementById('overlay').classList.remove('open');
        }
    </script>

    @stack('scripts')

    {{-- POPUP LOGIN RICHIESTO --}}
    <div class="overlay" id="overlay" onclick="closePopup()"></div>
    <div class="popup-login" id="popupLogin">
        <button class="popup-close" onclick="closePopup()">✕</button>
        <div class="popup-icon">📚</div>
        <h2>Accedi per continuare</h2>
        <p>Per sfogliare il catalogo e acquistare libri devi essere registrato su Librooz.</p>
        <a href="{{ route('login') }}" class="btn-primary" style="display:block;text-align:center;margin-bottom:10px;">Accedi</a>
        <a href="{{ route('register') }}" class="btn-secondary" style="display:block;text-align:center;">Registrati gratis</a>
    </div>

</body>
</html>