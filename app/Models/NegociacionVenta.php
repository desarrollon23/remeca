<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NegociacionVenta extends Model
{
    public $table = 'negociacion_ventas';
    use HasFactory;
    protected $fillable = ['id', 'fechan', 'cedulan', 'idlugarn', 'idtipopagon', 'idtipoabonon', 'observaciones', 'montotn', 'totalpagado', 'pesotn', 'restan', 'finalizada', 'amortizando'];
    //Relacion uno a muchos inversa con Proveedores y Productos
    public function Clientes(){
        return $this->belongsTo(Clientes::class);
    }
}
