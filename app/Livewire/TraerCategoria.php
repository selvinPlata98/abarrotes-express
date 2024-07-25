<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Categoria;

class TraerCategoria extends Component
{
    public $categoria;

    
    public function render()
    {
        $this->categoria = Categoria::all();
        return view('livewire.traer-categoria');
    }


}
