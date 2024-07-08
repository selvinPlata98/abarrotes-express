<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;

class Inicio extends Component
{

    public $producto;

    public function render()
    {
        $this->producto = Producto::all();
        return view('livewire.inicio');
    }
}
