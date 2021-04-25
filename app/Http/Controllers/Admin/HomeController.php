<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClaveMaestra;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        //return view('index');
        return view('dashboard');
    }
}
