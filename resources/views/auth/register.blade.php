<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati — Librooz</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url('{{ asset("images/immagine_login.jpg") }}');
            background-size: cover;
            background-position: center;
            z-index: 0;
        }

        /* ===== RIQUADRO SINISTRA ===== */
        .left-card {
            position: fixed;
            top: 3vh;
            left: 3vw;
            width: 46vw;
            height: 94vh;
            border: 3px solid rgba(255,255,255,0.7);
            border-radius: 20px 0 0 20px;
            border-right: none;
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
            left: calc(3vw + 46vw);
            width: 42vw;
            height: 94vh;
            background: white;
            border-radius: 0 20px 20px 0;
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2.5rem 3rem;
            box-shadow: 0 40px 100px rgba(0,0,0,0.5);
            overflow-y: auto;
        }

        .right-top { display: flex; justify-content: flex-end; }

        .brand {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.3rem;
            color: var(--ebano);
            letter-spacing: 3px;
            text-decoration: none;
        }

        .brand span { color: var(--bronzo); }

        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--ebano);
            margin-bottom: 0.3rem;
        }

        .form-subtitle {
            font-size: 0.82rem;
            color: var(--cemento);
            margin-bottom: 1.5rem;
        }

        .error-list {
            background: #fff5f5;
            border: 1px solid #feb2b2;
            border-radius: 6px;
            padding: 10px 14px;
            margin-bottom: 1rem;
            font-size: 0.8rem;
            color: #c53030;
        }

        .form-row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-group { margin-bottom: 1rem; }

        .form-group label {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--ebano);
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 11px 14px;
            background: #f7f7f5;
            border: 1.5px solid transparent;
            border-radius: 8px;
            font-size: 0.86rem;
            color: var(--ebano);
            outline: none;
            transition: border-color 0.3s;
            font-family: 'Inter', sans-serif;
        }

        .form-group input:focus { border-color: var(--bronzo); background: white; }
        .form-group input::placeholder { color: #bbb; }

        .form-optional {
            font-size: 0.72rem;
            color: var(--cemento);
            font-weight: 400;
        }

        .btn-register {
            width: 100%;
            padding: 13px;
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
            margin-top: 0.5rem;
        }

        .btn-register:hover { background: var(--tabacco); transform: translateY(-1px); }

        .right-bottom {
            text-align: center;
            font-size: 0.82rem;
            color: var(--cemento);
            padding-top: 1rem;
            border-top: 1px solid #f0f0f0;
            margin-top: 1rem;
        }

        .right-bottom a {
            color: var(--ebano);
            font-weight: 700;
            text-decoration: none;
        }

        .right-bottom a:hover { color: var(--bronzo); }

        @media (max-width: 900px) {
            .left-card { display: none; }
            .right-panel { left: 50%; transform: translateX(-50%); width: 90vw; right: auto; border-radius: 20px; }
        }
    </style>
</head>
<body>

    {{-- RIQUADRO SINISTRA --}}
    <div class="left-card">
        <p class="left-tag">Librooz</p>
        <div class="left-quote">
            <h2>Il tuo<br>mondo di<br><span>libri</span><br>inizia qui.</h2>
            <p>Crea il tuo account e accedi a migliaia di titoli, offerte esclusive e molto altro.</p>
        </div>
    </div>

    {{-- FORM DESTRA --}}
    <div class="right-panel">
        <div class="right-top">
            <a href="{{ route('home') }}" class="brand">Li<span>B</span>ROO<span>Z</span></a>
        </div>

        <div>
            <h1 class="form-title">Crea un account</h1>
            <p class="form-subtitle">Compila i campi per registrarti gratuitamente</p>

            @if($errors->any())
                <div class="error-list">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-row-2">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome"
                            placeholder="Mario" value="{{ old('nome') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="cognome">Cognome</label>
                        <input type="text" id="cognome" name="cognome"
                            placeholder="Rossi" value="{{ old('cognome') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                        placeholder="mario@email.com" value="{{ old('email') }}" required>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password"
                            placeholder="Min. 8 caratteri" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Conferma Password</label>
                        <input type="password" id="password_confirmation"
                            name="password_confirmation" placeholder="Ripeti password" required>
                    </div>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label for="telefono">Telefono <span class="form-optional">(opzionale)</span></label>
                        <input type="text" id="telefono" name="telefono"
                            placeholder="+39 000 0000000" value="{{ old('telefono') }}">
                    </div>
                    <div class="form-group">
                        <label for="cap">CAP <span class="form-optional">(opzionale)</span></label>
                        <input type="text" id="cap" name="cap"
                            placeholder="00100" value="{{ old('cap') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="localita">Città <span class="form-optional">(opzionale)</span></label>
                    <input type="text" id="localita" name="localita"
                        placeholder="Roma" value="{{ old('localita') }}">
                </div>

                <button type="submit" class="btn-register">Crea Account</button>
            </form>
        </div>

        <div class="right-bottom">
            Hai già un account? <a href="{{ route('login') }}">Accedi</a>
        </div>
    </div>

</body>
</html>