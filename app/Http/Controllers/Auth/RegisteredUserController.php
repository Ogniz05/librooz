<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Utente;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'nome'     => ['required', 'string', 'max:50'],
        'cognome'  => ['required', 'string', 'max:50'],
        'email'    => ['required', 'string', 'email', 'max:100', 'unique:Utente,email'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'telefono' => ['nullable', 'string', 'max:20'],
    ]);

    $user = Utente::create([
        'nome'     => $request->nome,
        'cognome'  => $request->cognome,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'telefono' => $request->telefono,
    ]);

    event(new Registered($user));
    Auth::login($user);

    return redirect(route('home'));
}
}
