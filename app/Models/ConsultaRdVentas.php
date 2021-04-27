<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaRdVentas extends Model
{
    use HasFactory;
    public $table = "vista_rd_ventas";
    protected $fillable = ['fecha', 'cedula', 'idproducto', 'cantidad', 'total'];
}
