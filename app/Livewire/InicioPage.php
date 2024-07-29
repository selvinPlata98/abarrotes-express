<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;

class InicioPage extends Component
{

    public $productos;
    public $categorias;
    public $marcas;

    public function render()
{
    $this->marcas = Marca::all();
    $this->categorias = Categoria::inRandomOrder()->limit(4)->get();
    $this->productos = Producto::inRandomOrder()->limit(4)->get();
    return view('livewire.inicio-page');
    }
}
