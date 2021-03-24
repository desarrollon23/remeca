<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleComprador extends Model
{
    public $table = "_ddetallecompras";
    protected $fillable = ['id', 'idcompra', 'idproducto', 'cantidadpro', 'operacion', 'preciopro', 'totalpro'];
    use HasFactory;
}
