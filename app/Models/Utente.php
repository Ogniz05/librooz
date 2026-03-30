<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Utente extends Authenticatable
{
    protected $table = 'Utente';
    protected $primaryKey = 'id_utente';
    public $timestamps = false;

    protected $fillable = [
        'nome', 'cognome', 'email', 'password',
        'telefono', 'via', 'civico', 'cap', 'localita'
    ];

    protected $hidden = ['remember_token'];

    public function getAuthIdentifierName()
    {
        return 'id_utente';
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function ordini() { return $this->hasMany(Ordine::class, 'id_utente'); }
    public function carrello() { return $this->hasMany(Carrello::class, 'id_utente'); }
    public function recensioni() { return $this->hasMany(Recensione::class, 'id_utente'); }
}