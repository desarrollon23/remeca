<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    public $table = "_iinventario";
    use HasFactory;
    protected $fillable = ['fecha','hora','idproducto','comprados','vendidos', 'existencia'];
}
