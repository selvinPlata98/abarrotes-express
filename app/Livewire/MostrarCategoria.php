<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Categoria;

class MostrarCategoria extends Component
{
    public $perPage = 9;

    public function render()
    {
        $categorias = Categoria::paginate($this->perPage);

        return view('livewire.mostrar-categoria', [
            'categorias' => $categorias,
        ]);
    }
}

