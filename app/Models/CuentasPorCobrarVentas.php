<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentasPorCobrarVentas extends Model
{
    use HasFactory;
    public $table = 'cuentas_por_cobrar_ventas';
    protected $fillable = ['id', 'idventa', 'idnegociacionventa', 'fecha', 'hora', 'cedula', 'montototal', 'totalefectivo', 'totaltransferencia', 'totalpagado', 'totalresta', 'finalizada', 'amortizando'];
}
