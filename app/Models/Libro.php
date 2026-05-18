<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    // Specifichiamo la tabella se diversa dal plurale standard di Laravel
    protected $table = 'Libro';
    protected $primaryKey = 'id_libro';
    public $timestamps = false; // Rimuovi o imposta a true a seconda del tuo database

    protected $fillable = [
        'titolo',
        'prezzo',
        'id_autore',
        'id_editore',
        'id_categoria',
        'anno_pubblicazione',
        'trama',
        'copertina'
    ];

    /**
     * Relazione con il modello Categoria
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    /**
     * Relazione con il modello Autore
     */
    public function autore()
    {
        return $this->belongsTo(Autore::class, 'id_autore', 'id_autore');
    }

    /**
     * Relazione con il modello Editore
     */
    public function editore()
    {
        return $this->belongsTo(Editore::class, 'id_editore', 'id_editore');
    }
}