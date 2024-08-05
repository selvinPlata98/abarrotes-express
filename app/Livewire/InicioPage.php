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

    public $productos;
    public $categorias;
    public $marcas;

    #[Title('Inicio - Abarrotes Express')]
    public function agregarCarrito($producto_id)
    {
        $total_count = CarritoManagement::agregarElmentoAlCarrito($producto_id);
        $this->dispatch('update-cart-count', ['conteo_total' => $total_count])->to(Navbar::class);
        $this->alert('success', 'El producto fue agregado al carrito', [
            'position' => 'bottom-end',
            'timer' => 2000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function render()
    {
        $this->marcas = Marca::all();
        $this->categorias = Categoria::inRandomOrder()->limit(4)->get();
        $this->productos = Producto::inRandomOrder()->limit(4)->get();
        return view('livewire.inicio-page');
    }
}
