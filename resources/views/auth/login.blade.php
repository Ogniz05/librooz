<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accedi — Librooz</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            background: var(--ebano);
            position: relative;
            overflow: hidden;
        }

        /* ===== SFONDO GLOBALE con gradiente bronzo/tabacco ===== */
body::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image: url('{{ asset("images/immagine_login.jpg") }}');
    background-size: cover;
    background-position: center;
    z-index: 0;
}

        /* ===== RIQUADRO SINISTRA (solo bordi visibili) ===== */
      .left-card {
    position: fixed;
    top: 3vh;
    left: 3vw;
    width: 46vw;
    height: 94vh;
    border: 3px solid rgba(255,255,255,0.7);
    border-radius: 20px 0 0 20px;  /* ← angoli solo a sinistra */
    border-right: none;             /* ← toglie il bordo destro */
    z-index: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 2.5rem;
    background: transparent;
}

        .left-tag {
            font-size: 0.7rem;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.35);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .left-tag::after {
            content: '';
            display: block;
            width: 40px;
            height: 1px;
            background: rgba(255,255,255,0.25);
        }

        .left-quote h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 4vw, 4rem);
            color: white;
            line-height: 1.1;
            margin-bottom: 1rem;
        }

        .left-quote h2 span { color: var(--bronzo); }

        .left-quote p {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.4);
            line-height: 1.7;
            max-width: 300px;
        }

        /* ===== FORM DESTRA ===== */
.right-panel {
    position: fixed;
    top: 3vh;
    left: calc(3vw + 46vw);        /* ← parte esattamente dove finisce il sinistro */
    width: 42vw;
    height: 94vh;
    background: white;
    border-radius: 0 20px 20px 0;  /* ← angoli solo a destra */
    z-index: 2;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 2.5rem 3rem;
    box-shadow: 0 40px 100px rgba(0,0,0,0.5);
    overflow-y: auto;
}

        .right-top {
            display: flex;
            justify-content: flex-end;
        }

        .brand {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.3rem;
            color: var(--ebano);
            letter-spacing: 3px;
            text-decoration: none;
        }

        .brand span { color: var(--bronzo); }

        .form-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            color: var(--ebano);
            margin-bottom: 0.4rem;
        }

        .form-subtitle {
            font-size: 0.82rem;
            color: var(--cemento);
            margin-bottom: 2rem;
        }

        .error-list {
            background: #fff5f5;
            border: 1px solid #feb2b2;
            border-radius: 6px;
            padding: 10px 14px;
            margin-bottom: 1.2rem;
            font-size: 0.8rem;
            color: #c53030;
        }

        .form-group { margin-bottom: 1.2rem; }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--ebano);
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 13px 14px;
            background: #f7f7f5;
            border: 1.5px solid transparent;
            border-radius: 8px;
            font-size: 0.88rem;
            color: var(--ebano);
            outline: none;
            transition: border-color 0.3s, background 0.3s;
            font-family: 'Inter', sans-serif;
        }

        .form-group input:focus {
            border-color: var(--bronzo);
            background: white;
        }

        .form-group input::placeholder { color: #bbb; }

        .password-wrapper { position: relative; }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            color: var(--cemento);
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 0.8rem;
            color: var(--cemento);
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] { accent-color: var(--bronzo); }

        .forgot-link {
            font-size: 0.8rem;
            color: var(--cemento);
            text-decoration: none;
            transition: color 0.3s;
        }

        .forgot-link:hover { color: var(--bronzo); }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--ebano);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .btn-login:hover { background: var(--tabacco); transform: translateY(-1px); }

        .right-bottom {
            text-align: center;
            font-size: 0.82rem;
            color: var(--cemento);
            padding-top: 1.2rem;
            border-top: 1px solid #f0f0f0;
        }

        .right-bottom a {
            color: var(--ebano);
            font-weight: 700;
            text-decoration: none;
        }

        .right-bottom a:hover { color: var(--bronzo); }

        @media (max-width: 900px) {
            .left-card { display: none; }
            .right-panel { left: 50%; transform: translateX(-50%); width: 90vw; right: auto; }
        }
    </style>
</head>
<body>

    {{-- RIQUADRO SINISTRA --}}
    <div class="left-card">
        <p class="left-tag">Librooz</p>
        <div class="left-quote">
            <h2>Leggi.<br><span>Scopri.</span><br>Sorridi.</h2>
            <p>Ogni libro è un viaggio. Accedi al tuo account e continua la tua avventura letteraria.</p>
        </div>
    </div>

    {{-- FORM DESTRA --}}
    <div class="right-panel">
        <div class="right-top">
            <a href="{{ route('home') }}" class="brand">Li<span>B</span>ROO<span>Z</span></a>
        </div>

        <div class="form-section">
            <h1 class="form-title">Bentornato</h1>
            <p class="form-subtitle">Inserisci email e password per accedere al tuo account</p>

            @if($errors->any())
                <div class="error-list">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                        placeholder="Inserisci la tua email"
                        value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password"
                            placeholder="Inserisci la tua password" required>
                        <button type="button" class="toggle-password" onclick="togglePassword()">👁</button>
                    </div>
                </div>

                <div class="form-row">
                    <label class="remember-me">
                        <input type="checkbox" name="remember"> Ricordami
                    </label>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Password dimenticata?</a>
                    @endif
                </div>

                <button type="submit" class="btn-login">Accedi</button>
            </form>
        </div>

        <div class="right-bottom">
            Non hai un account? <a href="{{ route('register') }}">Registrati</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>

</body>
</html>