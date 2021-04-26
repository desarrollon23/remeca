<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleDespacho extends Model
{
    use HasFactory;
    public $table = "detalledespacho";
    protected $fillable = ['id', 'iddespacho', 'idproducto', 'cantidadpro', 'despachado'];
}
