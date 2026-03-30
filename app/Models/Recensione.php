<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Recensione extends Model
{
    protected $table = 'Recensione';
    protected $primaryKey = 'id_recensione';
    public $timestamps = false;
    protected $fillable = ['id_libro', 'id_utente', 'voto', 'commento', 'data_pubblicazione'];

    public function libro() { return $this->belongsTo(Libro::class, 'id_libro'); }
    public function utente() { return $this->belongsTo(Utente::class, 'id_utente'); }
}
