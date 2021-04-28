<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreciosProductosProvClie extends Model
{
    use HasFactory;
    public $table = 'precios_productos_prov_clie';
    protected $filable = ['id', 'cedula', 'idproducto', 'precio'];
}
