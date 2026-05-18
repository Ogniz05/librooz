<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Mostra la vista di modifica del profilo.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Aggiorna le informazioni nel database.
     */
    public function update(Request $request)
    {
        $user = $request->user(); 
        $idUtente = $user->id_utente ?? $user->id;

        // 1. Validazione leggera per evitare blocchi stringenti
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:Utente,email,' . $idUtente . ',id_utente', 
            'address' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable',
            'banner' => 'nullable',
        ]);

        // 2. Mappatura campi testo
        $user->nome = $request->input('name');
        $user->email = $request->input('email');
        $user->via = $request->input('address');
        $user->bio = $request->input('bio');

        // 3. Salvataggio dell'Avatar con metodo alternativo .move()
        if ($request->hasFile('avatar')) {
            $avatarFile = $request->file('avatar');
            $avatarName = time() . '_avatar.' . $avatarFile->getClientOriginalExtension();
            
            // Sposta fisicamente il file nella cartella pubblica di storage
            $avatarFile->move(public_path('storage/avatars'), $avatarName);
            
            // Salva il percorso relativo nel database
            $user->avatar_path = 'avatars/' . $avatarName;
        }

        // 4. Salvataggio del Banner con metodo alternativo .move()
        if ($request->hasFile('banner')) {
            $bannerFile = $request->file('banner');
            $bannerName = time() . '_banner.' . $bannerFile->getClientOriginalExtension();
            
            // Sposta fisicamente il file nella cartella pubblica di storage
            $bannerFile->move(public_path('storage/banners'), $bannerName);
            
            // Salva il percorso relativo nel database
            $user->banner_path = 'banners/' . $bannerName;
        }

        // 5. Salva tutto sul DB
        $user->save();

        return redirect()->back()->with('success', 'Profilo aggiornato con successo!');
    }

    /**
     * Elimina l'account dell'utente.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}