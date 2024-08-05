<?php

namespace App\Livewire;

use App\Helpers\CarritoManagement;
use App\Livewire\Complementos\Navbar;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class InicioPage extends Component
{
    use LivewireAlert;

    public $producto;
    public $categoria;
    public $marca;
    #[Title('Inicio - Abarrotes Express')]

    public function agregarCarrito($producto_id){
        $total_count = CarritoManagement::agregarElmentoAlCarrito($producto_id);
        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);
        $this->alert('success', 'El producto fue agregado al carrito', [
            'position' => 'bottom-end',
            'timer' => 2000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }
    public function render()
{
    $this->marca = Marca::all();
    $this->categoria = Categoria::inRandomOrder()->limit(4)->get();
    $this->producto = Producto::inRandomOrder()->limit(4)->get();
    return view('livewire.inicio-page');
    }
}
