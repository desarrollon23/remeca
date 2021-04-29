<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaRelvennegDespachoDiario extends Model
{
    use HasFactory;
    public $table = "vista_relvenneg_despacho_diario";
    protected $fillable = ['fecha', 'cedula', 'idproducto', 'cantidad', 'total'];
}
