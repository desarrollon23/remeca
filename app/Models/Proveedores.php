<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;

    protected $fillable = ['cedula', 'nombre'];

    //Relacion uno a muchos con  recepcion de material
    public function almacens(){
        return $this->hasMany(Almacen::class);
    }
}
