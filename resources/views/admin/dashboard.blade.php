@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    :root { --bronzo: #c5a059; --ebano: #0a0a0a; --card-bg: #141414; --testo: #e0e0e0; }
    body { background: var(--ebano) !important; color: var(--testo); font-family: 'Poppins', sans-serif; }
    
    .admin-wrapper { display: flex; min-height: 100vh; }
    .sidebar { width: 280px; background: #000; border-right: 1px solid #222; padding: 2rem 1rem; position: fixed; height: 100vh; }
    .main-panel { flex: 1; margin-left: 280px; padding: 3rem; }

    .nav-pills .nav-link {
        color: #888; padding: 12px 20px; margin-bottom: 8px; border-radius: 10px; border: 1px solid transparent; transition: 0.3s;
    }
    .nav-pills .nav-link.active { background: rgba(197, 160, 89, 0.1) !important; color: var(--bronzo) !important; border-color: var(--bronzo); }
    
    .luxury-card { background: var(--card-bg); border: 1px solid #222; border-radius: 20px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
    .stat-box { background: #1a1a1a; padding: 1.5rem; border-radius: 15px; border-left: 4px solid var(--bronzo); }
    
    .form-control { background: #0f0f0f !important; border: 1px solid #333 !important; color: #fff !important; padding: 12px; }
    .btn-luxury { background: var(--bronzo); color: #000; font-weight: 700; border: none; padding: 15px; border-radius: 10px; transition: 0.3s; }
    .btn-luxury:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(197, 160, 89, 0.4); }

    .img-mini { width: 50px; height: 70px; object-fit: cover; border-radius: 5px; border: 1px solid #333; }
</style>

<div class="admin-wrapper">
    <div class="sidebar text-center">
        <h2 class="mb-5" style="font-family: 'Playfair Display'; color: var(--bronzo);">LIBROOZ</h2>
        <div class="nav flex-column nav-pills" id="admin-tabs" role="tablist">
            <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#tab-dash"><i class="fas fa-chart-pie me-2"></i> Dashboard</button>
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-nuovo"><i class="fas fa-plus-gold me-2"></i> Aggiungi Libro</button>
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-lista"><i class="fas fa-list me-2"></i> Inventario</button>
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-data"><i class="fas fa-users me-2"></i> Autori & Editori</button>
        </div>
    </div>

    <div class="main-panel">
        @if(session('success'))
            <div class="alert alert-success bg-dark text-success border-success mb-4 rounded-3">{{ session('success') }}</div>
        @endif

        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab-dash">
                <h1 class="mb-5" style="font-family: 'Playfair Display';">Panoramica <span style="color: var(--bronzo);">Catalogo</span></h1>
                <div class="row g-4">
                    <div class="col-md-4"><div class="stat-box"><small class="text-muted">VOLUMI TOTALI</small><h2 class="mb-0 fw-bold">{{ $stats['totale_libri'] }}</h2></div></div>
                    <div class="col-md-4"><div class="stat-box"><small class="text-muted">VALORE STIMATO</small><h2 class="mb-0 fw-bold">€ {{ number_format($stats['valore_magazzino'], 2) }}</h2></div></div>
                    <div class="col-md-4"><div class="stat-box"><small class="text-muted">PREZZO MEDIO</small><h2 class="mb-0 fw-bold">€ {{ number_format($stats['media_prezzo'], 2) }}</h2></div></div>
                </div>
            </div>

            <div class="tab-pane fade" id="tab-nuovo">
                <div class="luxury-card mx-auto" style="max-width: 800px;">
                    <h3 class="mb-4 text-center text-bronze">Acquisizione Nuovo Volume</h3>
                    <form action="{{ route('admin.libri.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12"><label class="small text-muted">TITOLO</label><input type="text" name="titolo" class="form-control" required></div>
                            <div class="col-md-6"><label class="small text-muted">NOME AUTORE</label><input type="text" name="autore_nome" class="form-control" required></div>
                            <div class="col-md-6"><label class="small text-muted">COGNOME AUTORE</label><input type="text" name="autore_cognome" class="form-control" required></div>
                            <div class="col-md-12"><label class="small text-muted">CASA EDITRICE</label><input type="text" name="editore_nome" class="form-control" required></div>
                            <div class="col-md-6"><label class="small text-muted">PREZZO (€)</label><input type="number" step="0.01" name="prezzo" class="form-control" required></div>
                            <div class="col-md-6"><label class="small text-muted">ANNO</label><input type="number" name="anno_pubblicazione" class="form-control"></div>
                            <div class="col-12"><label class="small text-muted">COPERTINA</label><input type="file" name="copertina" class="form-control"></div>
                            <div class="col-12"><button type="submit" class="btn-luxury w-100">SALVA NEL DATABASE</button></div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="tab-pane fade" id="tab-lista">
                <div class="luxury-card">
                    <h3 class="mb-4">📚 Inventario</h3>
                    <table class="table table-dark table-hover">
                        <thead><tr style="color: var(--bronzo);"><th>Cover</th><th>Titolo / Autore</th><th>Editore</th><th class="text-end">Prezzo</th></tr></thead>
                        <tbody>
                            @foreach($libri as $l)
                            <tr>
                                <td>
    @if($l->copertina)
        <img src="{{ asset('storage/' . $l->copertina) }}" 
             class="img-mini shadow" 
             style="width: 45px; height: 65px; object-fit: cover; border-radius: 5px; border: 1px solid var(--bronzo);">
    @else
        <div class="img-mini bg-dark d-flex align-items-center justify-content-center text-muted" 
             style="width: 45px; height: 65px; border-radius: 5px; border: 1px solid #333;">
            <i class="fas fa-book-open"></i>
        </div>
    @endif
</td>
                                <td><strong>{{ $l->titolo }}</strong><br><small class="text-muted">{{ $l->autore->nome }} {{ $l->autore->cognome }}</small></td>
                                <td><span class="badge border border-secondary">{{ $l->editore->nome ?? 'N/D' }}</span></td>
                                <td class="text-end fw-bold text-bronze">€ {{ number_format($l->prezzo, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="tab-data">
                <div class="row g-4">
                    <div class="col-md-6"><div class="luxury-card"><h4>Autori</h4>
                        @foreach($autori as $a)<div class="d-flex justify-content-between border-bottom border-secondary py-2">{{ $a->nome }} {{ $a->cognome }} <span class="text-bronze small">{{ $a->libri_count }} libri</span></div>@endforeach
                    </div></div>
                    <div class="col-md-6"><div class="luxury-card"><h4>Editori</h4>
                        @foreach($editori as $e)<div class="d-flex justify-content-between border-bottom border-secondary py-2">{{ $e->nome }} <span class="text-bronze small">{{ $e->libri_count }} volumi</span></div>@endforeach
                    </div></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection