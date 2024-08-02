<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Marca;

class MostrarMarcaPage extends Component
{
    public $perPage = 9;
    public $search = '';

    public function render()
    {
        $marcas = Marca::where('nombre', 'like', '%' . $this->search . '%')
            ->where('disponible', 1)
            ->paginate($this->perPage);

        return view('livewire.mostrar-marca-page', [
            'marcas' => $marcas,
        ]);
    }
}
