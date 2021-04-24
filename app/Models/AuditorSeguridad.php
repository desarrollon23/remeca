<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditorSeguridad extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'fechahora', 'idusuario', 'usuario', 'nombre', 'programa', 'operacion', 'ip', 'dispositivo'];
}
