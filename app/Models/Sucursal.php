<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    public $table = "sucursales";
    use HasFactory;

    protected $fillable = ['descripcion', 'direccion'];
}
