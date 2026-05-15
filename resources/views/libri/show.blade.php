@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    body { background: #0a0a0a !important; color: #e0e0e0; font-family: 'Poppins', sans-serif; }
    .btn-back { color: #c5a059; text-decoration: none; font-weight: 600; transition: 0.3s; }
    .btn-back:hover { color: #fff; padding-left: 5px; }
    
    /* Box Prodotto */
    .product-container { background: #141414; border: 1px solid #222; border-radius: 20px; padding: 3rem; margin-top: 2rem; }
    
    /* Immagine */
    .detail-copertina-wrap { background: #0f0f0f; border: 1px solid #333; border-radius: 12px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.7); text-align: center; }
    .detail-copertina { width: 100%; max-height: 500px; object-fit: cover; }
    .detail-placeholder { height: 450px; display: flex; align-items: center; justify-content: center; font-size: 5rem; color: #333; }

    /* Testi */
    .libro-titolo { font-family: 'Playfair Display'; color: #fff; font-size: 2.8rem; font-weight: 700; line-height: 1.2; }
    .libro-autore { font-size: 1.3rem; color: #c5a059; font-weight: 400; }
    .libro-prezzo { font-size: 2rem; color: #c5a059; font-weight: 600; }
    
    .info-label { font-size: 0.8rem; color: #666; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px; }
    .info-value { font-size: 1rem; color: #ddd; margin-bottom: 1.5rem; }
    
    .btn-buy { background: #c5a059; color: #000; font-weight: 600; padding: 12px 30px; border-radius: 8px; border: none; transition: 0.3s; }
    .btn-buy:hover { background: #fff; color: #000; transform: translateY(-2px); }
</style>

<div class="container py-5">
    <a href="{{ route('catalogo') }}" class="btn-back">
        <i class="fas fa-arrow-left me-2"></i> Torna al Catalogo
    </a>

    <div class="product-container shadow">
        <div class="row g-5">
            
            <div class="col-md-5">
                <div class="detail-copertina-wrap">
                    @if($libro->copertina)
                        <img src="{{ asset('storage/' . $libro->copertina) }}" class="detail-copertina" alt="{{ $libro->titolo }}">
                    @else
                        <div class="detail-placeholder">
                            <i class="fas fa-book"></i>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-7 d-flex flex-column justify-content-between">
                <div>
                    <h1 class="libro-titolo mb-2">{{ $libro->titolo }}</h1>
                    <p class="libro-autore mb-4">di {{ $libro->autore->nome ?? 'Autore' }} {{ $libro->autore->cognome ?? 'Sconosciuto' }}</p>
                    
                    <hr style="border-color: #333; margin: 2rem 0;">

                    <div class="mb-4">
                        <span class="info-label d-block">Prezzo di copertina</span>
                        <span class="libro-prezzo">€ {{ number_format($libro->prezzo, 2) }}</span>
                    </div>

                    <div class="mb-4">
                        <span class="info-label d-block">Sinossi</span>
                        <p class="text-muted" style="line-height: 1.6; font-size: 1.05rem;">
                            {{ $libro->trama ?? 'Nessuna trama disponibile per questo volume.' }}
                        </p>
                    </div>
                </div>

                <div>
                    <div class="row">
                        <div class="col-6 col-sm-4">
                            <span class="info-label d-block">Anno</span>
                            <p class="info-value">{{ $libro->anno_pubblicazione ?? 'N/D' }}</p>
                        </div>
                        <div class="col-6 col-sm-4">
                            <span class="info-label d-block">Categorie</span>
                            <p class="info-value">
                                @forelse($libro->categorie as $cat)
                                    <span class="badge bg-dark border border-secondary me-1">{{ $cat->nome_categoria ?? $cat->nome }}</span>
                                @empty
                                    <span class="text-muted small">Nessuna</span>
                                @endforelse
                            </p>
                        </div>
                    </div>

                    <hr style="border-color: #333; margin-top: 1rem;">

                    <div class="mt-4">
                        <button class="btn-buy shadow">
                            <i class="fas fa-shopping-bag me-2"></i> Aggiungi al Carrello
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection