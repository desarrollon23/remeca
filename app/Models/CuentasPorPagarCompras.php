<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentasPorPagarCompras extends Model
{
    use HasFactory;
    public $table='cuentas_por_pagar_compras';
    protected $fillable = ['id', 'idcompra', 'idnegociacioncompra', 'fecha', 'hora', 'cedula', 'montototal', 'totalefectivo', 'totaltransferencia', 'totalpagado', 'totalresta', 'finalizada', 'amortizando'];
}
