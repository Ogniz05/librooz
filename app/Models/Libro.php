<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table = 'Libro';
    protected $primaryKey = 'id_libro';
    public $timestamps = false;
    protected $fillable = ['titolo', 'prezzo', 'trama', 'anno_pubblicazione', 'id_autore', 'id_editore'];

    public function autore() { return $this->belongsTo(Autore::class, 'id_autore'); }
    public function editore() { return $this->belongsTo(Editore::class, 'id_editore'); }
    public function categorie() {
        return $this->belongsToMany(Categoria::class, 'Libro_Categoria', 'id_libro', 'id_categoria')
                    ->withPivot('id_libro_categoria');
    }
    public function recensioni() { return $this->hasMany(Recensione::class, 'id_libro'); }
}