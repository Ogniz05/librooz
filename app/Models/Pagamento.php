<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $table = 'Pagamento';
    protected $primaryKey = 'id_pagamento';
    public $timestamps = false;
    protected $fillable = ['id_ordine', 'metodo', 'data_pagamento', 'importo'];
}