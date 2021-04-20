<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecioProducto extends Model
{
    use HasFactory;
    /* public $table = 'precios_productos_prov_clie'; */
    public $table = 'vista_precio_prod_cedu';
    protected $filable = ['id', 'cedula', 'idproducto', 'precio'];
}
