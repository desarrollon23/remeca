<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaveMaestra extends Model
{
    use HasFactory;
    public $table = "clavemaestra";
    protected $fillable = ['id', 'idusuario', 'descripcion', 'clave'];
}
