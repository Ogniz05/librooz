@extends('layouts.app')

@section('title', 'Il mio Profilo')

@section('content')
<div class="container my-5" style="max-width: 900px; margin: auto; padding: 20px; font-family: sans-serif;">
    
    <div style="border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 35px;">
        <h1 style="color: #2c3e50; margin: 0;">👤 Gestione Profilo</h1>
        <p style="color: #7f8c8d; margin: 5px 0 0 0;">Aggiorna le informazioni del tuo account e la password.</p>
    </div>

    {{-- Sezione 1: Modifica Informazioni Profilo (Nome ed Email) --}}
    <div style="background: white; padding: 30px; border-radius: 8px; border: 1px solid #dee2e6; box-shadow: 0 4px 6px rgba(0,0,0,0.02); margin-bottom: 30px;">
        @include('profile.partials.update-profile-information-form')
    </div>

    {{-- Sezione 2: Modifica Password --}}
    <div style="background: white; padding: 30px; border-radius: 8px; border: 1px solid #dee2e6; box-shadow: 0 4px 6px rgba(0,0,0,0.02); margin-bottom: 30px;">
        @include('profile.partials.update-password-form')
    </div>

    {{-- Sezione 3: Elimina Account --}}
    <div style="background: #fff5f5; padding: 30px; border-radius: 8px; border: 1px solid #fab1a0; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
        @include('profile.partials.delete-user-form')
    </div>

</div>
@endsection