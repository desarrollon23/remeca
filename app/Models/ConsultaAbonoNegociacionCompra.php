<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaAbonoNegociacionCompra extends Model
{
    use HasFactory;
    public $table = 'vista_abono_negociacion_compra';
    protected $fillable = ['id'];
}
