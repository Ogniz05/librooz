<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DettagliOrdine extends Model
{
    protected $table = 'DettagliOrdine';
    protected $primaryKey = 'id_dettaglio_ordine';
    public $timestamps = false;
    protected $fillable = ['id_ordine', 'id_libro', 'quantita', 'prezzo_unitario'];

    public function libro() { return $this->belongsTo(Libro::class, 'id_libro'); }
    public function ordine() { return $this->belongsTo(Ordine::class, 'id_ordine'); }
}