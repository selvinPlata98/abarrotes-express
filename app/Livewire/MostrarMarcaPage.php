<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Marca;

class MostrarMarcaPage extends Component
{
    public $perPage = 9;
    public function render()
    
    {
        $marcas = Marca::paginate($this->perPage);

        return view('livewire.mostrar-marca-page',[
            'marcas' => $marcas,
        ]);

    }
}
