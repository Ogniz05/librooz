<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Autore extends Model
{
    protected $table = 'Autore';
    protected $primaryKey = 'id_autore';
    public $timestamps = false;
    protected $fillable = ['nome', 'cognome', 'biografia', 'nazionalita'];

    public function libri() { return $this->hasMany(Libro::class, 'id_autore'); }
}