<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public $table = "_pproductos";

    use HasFactory;

    protected $fillable = ['descripcion', 'precio', 'cantidad'];

    //Relacion uno a muchos con  recepcion de material
    public function almacens(){
        return $this->hasMany(Almacen::class);
    }
}
