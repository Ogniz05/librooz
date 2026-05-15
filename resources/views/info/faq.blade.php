@extends('layouts.app')

@section('title', 'Domande Frequenti (FAQ)')

@section('content')
    <div class="container my-5"
        style="max-width: 800px; margin: auto; padding: 20px; font-family: sans-serif; line-height: 1.6;">
        <h1 style="color: #2c3e50; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 30px;">❓ Domande
            Frequenti (FAQ)</h1>

        <div style="margin-bottom: 25px;">
            <h4 style="color: #2980b9; margin-bottom: 5px;">Posso tracciare la mia spedizione?</h4>
            <p style="margin: 0;">Sì! Appena il tuo pacco verrà affidato al corriere, riceverai un'email contenente il link
                di tracciamento per seguire la consegna in tempo reale.</p>
        </div>
        <div style="margin-bottom: 25px;">
            <h4 style="color: #2980b9; margin-bottom: 5px;">Quali metodi di pagamento accettate?</h4>
            <p style="margin: 0;">Accettiamo tutte le principali carte di credito, di debito e PayPal.</p>
        </div>
    </div>
@endsection
