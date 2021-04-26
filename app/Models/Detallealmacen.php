<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detallealmacen extends Model
{
    use HasFactory;
    public $table = "detallerecmat";
    protected $fillable = ['id', 'recepcionmaterial_id', 'producto_id', 'cantidadprorecmat', 'operacion'];
}
