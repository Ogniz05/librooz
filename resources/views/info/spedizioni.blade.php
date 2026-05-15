@extends('layouts.app')

@section('title', 'Informazioni sulla Spedizione')

@section('content')
    <div class="container my-5"
        style="max-width: 800px; margin: auto; padding: 20px; font-family: sans-serif; line-height: 1.6;">
        <h1 style="color: #2c3e50; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 20px;">🚚 Spedizioni e
            Consegna</h1>
        <p>Ci affidiamo ai migliori corrieri espressi per garantire che i tuoi libri arrivino a destinazione in condizioni
            perfette e nel minor tempo possibile.</p>

        <h3 style="color: #34495e; margin-top: 30px;">Tempi e Costi</h3>
        <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <tr style="background: #f8f9fa; border-bottom: 2px solid #eee;">
                <th style="padding: 10px; text-align: left;">Tipo Spedizione</th>
                <th style="padding: 10px; text-align: left;">Tempi</th>
                <th style="padding: 10px; text-align: left;">Costo</th>
            </tr>
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 10px;">Spedizione Standard</td>
                <td style="padding: 10px;">3-5 giorni lavorativi</td>
                <td style="padding: 10px;">3,90€ (Gratis sopra i 29€)</td>
            </tr>
        </table>
    </div>
@endsection
