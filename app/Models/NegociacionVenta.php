<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NegociacionVenta extends Model
{
    use HasFactory;
    public $table = 'negociacion_ventas';
    protected $fillable = ['id', 'fechan', 'horan', 'cedulan', 'idlugarn', 'idtipopagon', 'idtipoabonon', 'observaciones', 'montotn', 'efectivo', 'transferencia', 'totalpagado', 'pesotn', 'restan', 'finalizada', 'amortizando'];

    //Relacion uno a muchos inversa con Proveedores y Productos
    public function Clientes(){
        return $this->belongsTo(Clientes::class);
    }
}
