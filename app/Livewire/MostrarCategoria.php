<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Categoria;

class MostrarCategoria extends Component
{

    public $categorias;

    public function mount()
    {
        $this->categorias = Categoria::all();
    }
    public function render()
    {
        return view('livewire.mostrar-categoria');
    }
}