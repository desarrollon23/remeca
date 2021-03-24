<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class almacen extends Model
{
    public $table = "recepcionmaterial";
    use HasFactory;
    protected $fillable = ['id', 'fecha', 'cedula', 'idlugar', 'pesofull', 'pesovacio', 'pesoneto', 'pesocalculado', 'observaciones'];

    //Relacion uno a muchos inversa con Proveedores y Productos
    public function Proveedores(){
        return $this->belongsTo(Proveedores::class);
    }

    public function Producto(){
        return $this->belongsTo(Producto::class);
    }
}
