@extends('layouts.app')

@section('content')
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --bronzo: #c5a059;
            --ebano: #0a0a0a;
            --card-bg: #141414;
            --testo: #e0e0e0;
        }

        body {
            background: var(--ebano) !important;
            color: var(--testo);
            font-family: 'Poppins', sans-serif;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: #000;
            border-right: 1px solid #222;
            padding: 2rem 1rem;
            position: fixed;
            height: 100vh;
            z-index: 100;
        }

        .main-panel {
            flex: 1;
            margin-left: 280px;
            padding: 3rem;
            background: var(--ebano);
        }

        .nav-pills .nav-link {
            color: #888;
            padding: 12px 20px;
            margin-bottom: 8px;
            border-radius: 10px;
            border: 1px solid transparent;
            transition: 0.3s;
            text-align: left;
            width: 100%;
        }

        .nav-pills .nav-link.active {
            background: rgba(197, 160, 89, 0.1) !important;
            color: var(--bronzo) !important;
            border-color: var(--bronzo);
        }

        .luxury-card {
            background: var(--card-bg);
            border: 1px solid #222;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .stat-box {
            background: #1a1a1a;
            padding: 1.5rem;
            border-radius: 15px;
            border-left: 4px solid var(--bronzo);
            height: 100%;
            transition: 0.3s;
        }

        .stat-box:hover {
            transform: translateY(-3px);
        }

        .form-control,
        .form-select {
            background: #0f0f0f !important;
            border: 1px solid #333 !important;
            color: #fff !important;
            padding: 12px;
            border-radius: 10px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--bronzo) !important;
            box-shadow: 0 0 0 0.25rem rgba(197, 160, 89, 0.2) !important;
        }

        .btn-luxury {
            background: var(--bronzo);
            color: #000;
            font-weight: 700;
            border: none;
            padding: 15px;
            border-radius: 10px;
            transition: 0.3s;
        }

        .btn-luxury:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(197, 160, 89, 0.4);
            color: #000;
        }

        .img-mini {
            width: 50px;
            height: 70px;
            object-fit: cover;
            border-radius: 5px;
            border: 1px solid #333;
        }

        .badge-stato {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.75rem;
            border: 1px solid transparent;
            display: inline-block;
        }

        .stato-attesa {
            background: rgba(245, 158, 11, 0.1);
            color: #fbbf24;
            border-color: rgba(245, 158, 11, 0.3);
        }

        .stato-spedito {
            background: rgba(59, 130, 246, 0.1);
            color: #60a5fa;
            border-color: rgba(59, 130, 246, 0.3);
        }

        .stato-consegnato {
            background: rgba(16, 185, 129, 0.1);
            color: #34d399;
            border-color: rgba(16, 185, 129, 0.3);
        }
    </style>

    <div class="admin-wrapper">
        <div class="sidebar d-flex flex-column justify-content-between">
            <div>
                <h2 class="text-center mb-5"
                    style="font-family: 'Playfair Display'; color: var(--bronzo); tracking-width: 2px;">LIBROOZ</h2>
                <div class="nav flex-column nav-pills" id="admin-tabs" role="tablist">
                    <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#tab-dash"><i
                            class="fas fa-chart-pie me-2"></i> Dashboard</button>
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-nuovo"><i
                            class="fas fa-plus me-2"></i> Aggiungi Libro</button>
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-lista"><i
                            class="fas fa-book me-2"></i> Inventario Libri</button>
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-ordini"><i
                            class="fas fa-shopping-bag me-2"></i> Ordini Clienti</button>
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-utenti"><i
                            class="fas fa-users me-2"></i> Utenti Iscritti</button>
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-data"><i
                            class="fas fa-feather-alt me-2"></i> Autori & Editori</button>
                </div>
            </div>
            <div class="text-center mt-5 pt-4 border-top border-secondary/30">
                <a href="{{ route('home') }}"
                    class="btn btn-outline-secondary btn-sm w-100 rounded-3 text-muted border-secondary"
                    style="font-size: 0.8rem;">
                    <i class="fas fa-globe me-1"></i> Torna al Negozio
                </a>
            </div>
        </div>

        <div class="main-panel">
            @if (session('success'))
                <div class="alert alert-success bg-dark text-success border-success mb-4 rounded-3">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="tab-content">

                <div class="tab-pane fade show active" id="tab-dash">
                    <h1 class="mb-2" style="font-family: 'Playfair Display';">Pannello <span
                            style="color: var(--bronzo);">Amministrazione</span></h1>
                    <p class="text-muted mb-5">Panoramica andamento commerciale e statistiche di magazzino.</p>

                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="stat-box"><small class="text-muted uppercase tracking-wider block mb-1">VOLUMI A
                                    CATALOGO</small>
                                <h2 class="mb-0 fw-bold text-white">{{ $stats['totale_libri'] }}</h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-box"><small class="text-muted uppercase tracking-wider block mb-1">VALORE
                                    STIMATO</small>
                                <h2 class="mb-0 fw-bold" style="color: #34d399;">€
                                    {{ number_format($stats['valore_magazzino'], 2, ',', '.') }}</h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-box"><small class="text-muted uppercase tracking-wider block mb-1">PREZZO
                                    MEDIO</small>
                                <h2 class="mb-0 fw-bold text-info">€
                                    {{ number_format($stats['media_prezzo'], 2, ',', '.') }}</h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-box" style="border-left-color: #a855f7;"><small
                                    class="text-muted uppercase tracking-wider block mb-1">ORDINI TOTALI</small>
                                <h2 class="mb-0 fw-bold text-white">{{ $stats['totale_ordini'] }}</h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-box" style="border-left-color: #f59e0b;"><small
                                    class="text-muted uppercase tracking-wider block mb-1">ORDINI DA EVADERE</small>
                                <h2 class="mb-0 fw-bold text-warning">{{ $stats['ordini_in_attesa'] }}</h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-box" style="border-left-color: #ec4899;"><small
                                    class="text-muted uppercase tracking-wider block mb-1">CLIENTI ISCRITTI</small>
                                <h2 class="mb-0 fw-bold" style="color: #ec4899;">{{ $stats['totale_utenti'] }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-nuovo">
                    <div class="luxury-card mx-auto" style="max-width: 850px;">
                        <h3 class="mb-4 text-center" style="font-family: 'Playfair Display'; color: var(--bronzo);">
                            Acquisizione Nuovo Volume</h3>
                        <form action="{{ route('admin.libri.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12"><label class="small text-muted fw-bold">TITOLO VOLUME</label><input
                                        type="text" name="titolo" class="form-control" required></div>
                                <div class="col-md-6"><label class="small text-muted fw-bold">NOME AUTORE</label><input
                                        type="text" name="autore_nome" class="form-control" required></div>
                                <div class="col-md-6"><label class="small text-muted fw-bold">COGNOME AUTORE</label><input
                                        type="text" name="autore_cognome" class="form-control" required></div>
                                <div class="col-md-6"><label class="small text-muted fw-bold">CASA EDITRICE</label><input
                                        type="text" name="editore_nome" class="form-control" required></div>

                                <div class="col-md-6">
                                    <label class="small text-muted fw-bold">CATEGORIA / GENERE</label>
                                    <select name="id_categoria" class="form-select text-white" required>
                                        <option value="" disabled selected>Seleziona una categoria...</option>
                                        @foreach ($categorie as $cat)
                                            <option value="{{ $cat->id_categoria }}">{{ $cat->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6"><label class="small text-muted fw-bold">PREZZO DI COPERTINA
                                        (€)</label><input type="number" step="0.01" name="prezzo"
                                        class="form-control" required></div>
                                <div class="col-md-6"><label class="small text-muted fw-bold">ANNO
                                        PUBBLICAZIONE</label><input type="number" name="anno_pubblicazione"
                                        class="form-control"></div>
                                <div class="col-12"><label class="small text-muted fw-bold">TRAMA / SINOPSI</label>
                                    <textarea name="trama" rows="4" class="form-control"></textarea>
                                </div>
                                <div class="col-12"><label class="small text-muted fw-bold">FILE COPERTINA (.JPG, .PNG,
                                        .WEBP)</label><input type="file" name="copertina" class="form-control"></div>
                                <div class="col-12 mt-4"><button type="submit" class="btn-luxury w-100">REGISTRA OPERA
                                        NEL DATABASE</button></div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-lista">
                    <div class="luxury-card">
                        <h3 class="mb-4" style="font-family: 'Playfair Display';"><i
                                class="fas fa-book text-muted me-2"></i> Inventario Volumi</h3>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover align-middle">
                                <thead>
                                    <tr style="color: var(--bronzo);">
                                        <th>Copertina</th>
                                        <th>Titolo / Autore</th>
                                        <th>Genere</th>
                                        <th>Editore</th>
                                        <th class="text-end">Prezzo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($libri as $l)
                                        <tr>
                                            <td>
                                                @if ($l->copertina)
                                                    <img src="{{ asset('storage/' . $l->copertina) }}"
                                                        class="img-mini shadow" style="border: 1px solid var(--bronzo);">
                                                @else
                                                    <div class="img-mini bg-dark d-flex align-items-center justify-content-center text-muted"
                                                        style="border: 1px solid #333;"><i class="fas fa-book-open"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td><strong>{{ $l->titolo }}</strong><br><small
                                                    class="text-muted">{{ $l->autore->nome }}
                                                    {{ $l->autore->cognome }}</small></td>
                                            <td><span class="badge bg-dark border border-secondary text-light px-2 py-1.5"
                                                    style="font-size: 0.75rem;">{{ $l->categoria->nome ?? 'Generico' }}</span>
                                            </td>
                                            <td><span class="text-muted">{{ $l->editore->nome ?? 'N/D' }}</span></td>
                                            <td class="text-end fw-bold" style="color: var(--bronzo);">€
                                                {{ number_format($l->prezzo, 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-ordini">
                    <div class="luxury-card">
                        <h3 class="mb-4" style="font-family: 'Playfair Display';"><i
                                class="fas fa-shopping-bag text-muted me-2"></i> Storico Ordini Ricevuti</h3>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover align-middle">
                                <thead>
                                    <tr style="color: var(--bronzo);">
                                        <th>ID</th>
                                        <th>Acquirente</th>
                                        <th>Data Ordine</th>
                                        <th>Totale</th>
                                        <th>Stato Spedizione</th>
                                        <th class="text-end">Aggiorna Stato</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ordini as $ord)
                                        <tr>
                                            <td><span class="text-muted">#{{ $ord->id_ordine }}</span></td>
                                            <td>
                                                <strong>{{ $ord->utente->name ?? $ord->id_utente }}</strong><br>
                                                <small class="text-muted"
                                                    style="font-size: 0.75rem;">{{ $ord->utente->email ?? '' }}</small>
                                            </td>
                                            <td><small>{{ date('d/m/Y H:i', strtotime($ord->data_ordine)) }}</small></td>
                                            <td class="fw-bold text-success">€
                                                {{ number_format($ord->totale_ordine, 2, ',', '.') }}</td>
                                            <td>
                                                <span
                                                    class="badge-stato 
                                            {{ $ord->stato == 'In lavorazione' ? 'stato-attesa' : '' }}
                                            {{ $ord->stato == 'Spedito' ? 'stato-spedito' : '' }}
                                            {{ $ord->stato == 'Consegnato' ? 'stato-consegnato' : '' }}
                                        ">
                                                    {{ $ord->stato ?? 'In lavorazione' }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <form action="{{ route('admin.ordini.updateStato', $ord->id_ordine) }}"
                                                    method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="stato" onchange="this.form.submit()"
                                                        class="form-select form-select-sm bg-black border-secondary text-white py-1"
                                                        style="font-size: 0.8rem; width: 140px;">
                                                        <option value="In lavorazione"
                                                            {{ $ord->stato == 'In lavorazione' ? 'selected' : '' }}>In
                                                            lavorazione</option>
                                                        <option value="Spedito"
                                                            {{ $ord->stato == 'Spedito' ? 'selected' : '' }}>Spedito
                                                        </option>
                                                        <option value="Consegnato"
                                                            {{ $ord->stato == 'Consegnato' ? 'selected' : '' }}>Consegnato
                                                        </option>
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center p-4 text-muted italic">Nessun ordine
                                                presente nel database.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-utenti">
                    <div class="luxury-card">
                        <h3 class="mb-4" style="font-family: 'Playfair Display';"><i
                                class="fas fa-users text-muted me-2"></i> Registro Anagrafica Clienti</h3>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover align-middle">
                                <thead>
                                    <tr style="color: var(--bronzo);">
                                        <th>ID</th>
                                        <th>Nome / Username</th>
                                        <th>Indirizzo Email</th>
                                        <th>Indirizzo Spedizione</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($utenti as $u)
                                        <tr>
                                            <td><span class="text-muted">#{{ $u->id_utente }}</span></td>
                                            <td><strong
                                                    class="text-white">{{ $u->name ?? ($u->username ?? 'N/D') }}</strong>
                                            </td>
                                            <td style="color: var(--bronzo);">{{ $u->email }}</td>
                                            <td>
                                                @if ($u->via || $u->citta)
                                                    <small class="text-muted">{{ $u->via }} - {{ $u->citta }}
                                                        ({{ $u->cap ?? '' }})</small>
                                                @else
                                                    <span class="text-secondary italic" style="font-size: 0.8rem;">Dati
                                                        non completati</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center p-4 text-muted">Nessun utente registrato
                                                trovato.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-data">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="luxury-card">
                                <h4 class="mb-4" style="font-family: 'Playfair Display'; color: var(--bronzo);">Autori
                                    Registrati</h4>
                                @foreach ($autori as $a)
                                    <div
                                        class="d-flex justify-content-between border-bottom border-secondary py-2 align-items-center">
                                        <span>{{ $a->nome }} {{ $a->cognome }}</span>
                                        <span class="badge border border-secondary text-bronze px-2 py-1"
                                            style="font-size: 0.75rem;">{{ $a->libri_count }} opere</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="luxury-card">
                                <h4 class="mb-4" style="font-family: 'Playfair Display'; color: var(--bronzo);">Editori
                                    Associati</h4>
                                @foreach ($editori as $e)
                                    <div
                                        class="d-flex justify-content-between border-bottom border-secondary py-2 align-items-center">
                                        <span>{{ $e->nome }}</span>
                                        <span class="badge border border-secondary text-bronze px-2 py-1"
                                            style="font-size: 0.75rem;">{{ $e->libri_count }} volumi</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
