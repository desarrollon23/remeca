<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;
    public $table = "detalle_ventas";
    protected $fillable = ['id', 'idventa', 'idproductov', 'cantidadprov', 'operacionv', 'precioprov', 'totalprov'];
}
