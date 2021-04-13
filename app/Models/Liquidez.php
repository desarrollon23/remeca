<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquidez extends Model
{
    public $table = "liquidez";
    protected $fillable = ['efectivo', 'banco'];
}
 	