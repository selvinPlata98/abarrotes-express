<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;

class Inicio extends Component
{

    public $producto;
    public $categoria;
    public $marca;

    public function render()
{
    $this->marca = Marca::all();
    $this->categoria = Categoria::inRandomOrder()->limit(4)->get();
    $this->producto = Producto::inRandomOrder()->limit(4)->get();
    return view('livewire.inicio');
    }
}
