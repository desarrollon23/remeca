<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCuentasPorCobrarVentas extends Model
{
    use HasFactory;
    /* public $table = 'negociacion_ventas';
    protected $fillable = ['idcpcv', 'fecha', 'hora', 'efectivo', 'transferencia', 'pagado', 'resta']; */
    public $table = 'detalle_cuentas_por_cobrar_ventas';
    protected $fillable = ['id','idcpcv', 'fecha', 'hora', 'efectivo', 'transferencia', 'pagado', 'resta'];
}
