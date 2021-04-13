<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoNegociacionVenta extends Model
{
    use HasFactory;
    public $table = "pago_negociacion_ventas";
    protected $fillable = ['negociacion_id', 'fechapagonegven', 'horapagonegven', 'montoefec', 'montotran', 'totalpago', 'restapago'];
}
