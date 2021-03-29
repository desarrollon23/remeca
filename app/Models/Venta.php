<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public $table = "ventas";
    use HasFactory;
    protected $fillable = ['id', 'fechaventa', 'horaventa', 'cedulav', 'idlugarv', 'pesofullv', 'pesovaciov', 'pesonetov', 'pesocalculadov', 'idestatuspagov', 'idtipopagov', 'totalcomrav', 'totalpagadov', 'diferenciapagov', 'ajusteporpesov', 'observacionesv', 'despachado'];

    //Relacion uno a muchos inversa con Proveedores y Productos
    public function Proveedores(){
        return $this->belongsTo(Proveedores::class);
    }

    public function Producto(){
        return $this->belongsTo(Producto::class);
    }
}
