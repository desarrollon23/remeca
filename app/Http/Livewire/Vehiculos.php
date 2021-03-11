<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Vehiculos extends Component
{

    public $vehiculos = ['Camión 1', 'Camión 2', 'Camión 3', 'Camión 4'];

    public $vehiculo;

    public function render()
    {
        return view('livewire.vehiculos');
    }

    public function agregar() {
        array_push($this->vehiculos, $this->vehiculo);
        $this->reset('vehiculo');
    }
}
