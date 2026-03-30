<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'Categoria';
    protected $primaryKey = 'id_categoria';
    public $timestamps = false;
    protected $fillable = ['nome_categoria', 'descrizione'];

    public function libri() {
        return $this->belongsToMany(Libro::class, 'Libro_Categoria', 'id_categoria', 'id_libro')
                    ->withPivot('id_libro_categoria');
    }
}