<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

class ProductoPage extends Component
{
    #[Title('Detalles del producto')]
    #[Url]

    public $cantidad;
    public $enlace;
    public $id;

    public function mount($id){
            $this->enlace = $id;
    }

    public function render()
    {
        return view('livewire.producto-page',
        ['producto' => Producto::where('id', $this->id)->firstOrFail()]);
    }
}
