<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DespachoMaterial extends Model
{
    use HasFactory;
    public $table = "despacho_material";
    protected $fillable = ['id', 'fechaventad', 'horaventad', 'idlugard', 'idestatusd'];
}
