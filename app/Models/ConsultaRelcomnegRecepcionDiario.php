<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaRelcomnegRecepcionDiario extends Model
{
    use HasFactory;
    public $table = "vista_relcomneg_recepcion_diario";
    protected $fillable = ['fecha', 'cedula', 'idproducto', 'cantidad', 'total'];
}
