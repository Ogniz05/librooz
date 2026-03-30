<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Ordine extends Model
{
    protected $table = 'Ordine';
    protected $primaryKey = 'id_ordine';
    public $timestamps = false;
    protected $fillable = ['id_utente', 'data_ordine', 'stato', 'totale_ordine', 'is_pagato'];

    public function utente() { return $this->belongsTo(Utente::class, 'id_utente'); }
    public function dettagli() { return $this->hasMany(DettagliOrdine::class, 'id_ordine'); }
    public function pagamento() { return $this->hasOne(Pagamento::class, 'id_ordine'); }
}