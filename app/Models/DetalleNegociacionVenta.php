<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleNegociacionVenta extends Model
{
    public $table = "detalle_negociacion_ventas";
    use HasFactory;
    protected $fillable = ['id', 'negociacion_id', 'producto_idn', 'cantidadprorecmatn', 'precionegn', 'totalpronegn'];
}
