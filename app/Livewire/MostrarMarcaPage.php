<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\Marca;

class MostrarMarcaPage extends Component
{
    #[Url]
    public $perPage = 9;
    public $search = '';

    public function render()
    
    {
        $marcas = Marca::paginate($this->perPage);

        return view('livewire.mostrar-marca-page',[
            'marcas' => $marcas,
        ]);

    }
}
