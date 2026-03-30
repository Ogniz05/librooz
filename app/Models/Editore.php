<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Editore extends Model
{
    protected $table = 'Editore';
    protected $primaryKey = 'id_editore';
    public $timestamps = false;
    protected $fillable = ['nome', 'sede'];

    public function libri() { return $this->hasMany(Libro::class, 'id_editore'); }
}