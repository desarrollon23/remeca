<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NegociacionVenta extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'fecha', 'cedula', 'idestatuspago', 'idtipopago', 'totalpeson', 'totalpagon', 'observacionesc'];

    //Relacion uno a muchos inversa con Proveedores y Productos
    public function Proveedores(){
        return $this->belongsTo(Proveedores::class);
    }
    

}
