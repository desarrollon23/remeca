<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    public $table = "_ccompras";
    use HasFactory;
    protected $fillable = ['id', 'idrecepcion', 'fecharecepcion', 'fechacompra', 'hora', 'cedula', 'idlugar', 'idestatuspago', 'idtipopago', 'efectivo', 'transferencia', 'idtipoabonov', 'negociacion_id', 'totalcomra', 'totalpagado', 'diferenciapago', 'observacionesc'];

    //Relacion uno a muchos inversa con Proveedores y Productos
    public function Proveedores(){
        return $this->belongsTo(Proveedores::class);
    }

    public function Producto(){
        return $this->belongsTo(Producto::class);
    }
}
