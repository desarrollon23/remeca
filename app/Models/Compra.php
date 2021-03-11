<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    public $table = "_ccompras";
    use HasFactory;

    protected $fillable = ['cedula'];
}
