<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public $table = "detallerecmat";
    use HasFactory;
    protected $fillable = ['recepcionmaterial_id', 'producto_id', 'cantidadprorecmat', 'operacion'];
}
