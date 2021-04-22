<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCuentasPorPagarCompras extends Model
{
    use HasFactory;
    public $table = 'detalle_cuentas_por_pagar_compras';
    protected $fillable = ['id','idcppc', 'fecha', 'hora', 'efectivo', 'transferencia', 'pagado', 'resta'];
}
