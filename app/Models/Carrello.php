<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Carrello extends Model
{
    protected $table = 'Carrello';
    protected $primaryKey = 'id_carrello';
    public $timestamps = false;
    protected $fillable = ['id_utente', 'id_libro', 'data_ultima_modifica'];

    public function libro() { return $this->belongsTo(Libro::class, 'id_libro'); }
}