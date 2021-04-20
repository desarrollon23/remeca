<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleNegociacionCompra extends Model
{
    use HasFactory;
    public $table = "detalle_negociacion_compras";
    protected $fillable = ['id', 'negociacion_id', 'producto_idn', 'cantidadprorecmatn', 'precionegn', 'totalpronegn', 'cantidadprorecmatndebe'];
}
