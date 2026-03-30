<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'Admin';
    protected $primaryKey = 'id_admin';
    public $timestamps = false;
    protected $fillable = ['username', 'email', 'password'];
    protected $hidden = ['password'];
}