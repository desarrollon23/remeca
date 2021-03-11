<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class almacen extends Model
{
    public $table = "recepcionmaterial";
    use HasFactory;
    protected $fillable = [ 'fecha', 'cedula', 'idlugar', 'pesofull', 'pesovacio', 'pesoneto', 'pesocalculado', 'observaciones',
];
}
