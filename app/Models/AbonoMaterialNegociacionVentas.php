<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbonoMaterialNegociacionVentas extends Model
{
    use HasFactory;
    public $table = "abono_material_negociacion_ventas";
    protected $fillable = ['id', 'negociacion_id', 'idproducton', 'cantidadpron', 'debepron', 'iddespacho', 'despachado'];
}
