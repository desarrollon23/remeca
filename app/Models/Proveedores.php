<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;

    protected $fillable = ['cedula', 'nombre', 'direccion', 'telefono', 'correo', 'visible'];

    //Relacion uno a muchos con recepcion de material recepcionmaterial
    public function almacens(){
        return $this->hasMany(Almacen::class);
    }

    //Relacion uno a muchos con compra de material _ccompras
    public function purchases(){
        return $this->hasMany(Compra::class);
    }
}
