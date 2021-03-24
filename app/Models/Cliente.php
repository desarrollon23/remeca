<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = ['cedulac', 'nombrec', 'direccionc', 'telefonoc', 'correoc', 'visiblec'];

    //Relacion uno a muchos con recepcion de material recepcionmaterial
    public function NegociacionVenta(){
        return $this->hasMany(NegociacionVenta::class);
    }

    //Relacion uno a muchos con compra de material _ccompras
    public function purchases(){
        return $this->hasMany(Venta::class);
    }
}
