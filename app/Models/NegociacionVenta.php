<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NegociacionVenta extends Model
{
    public $table = 'negociacion_ventas';
    use HasFactory;
    protected $fillable = ['id', 'fechan', 'cedulan', 'idlugarn', 'idtipopagon', 'idtipoabonon', 'observaciones', 'finalizada'];
    //Relacion uno a muchos inversa con Proveedores y Productos
    public function Proveedores(){
        return $this->belongsTo(Proveedores::class);
    }
}
