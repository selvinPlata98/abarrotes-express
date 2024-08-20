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
        $conteo_total = CarritoManagement::agregarElmentoAlCarrito($producto_id);

        if (is_numeric($conteo_total)) {
            // Si la operación fue exitosa y se devuelve el conteo total
            $this->dispatch('update-cart-count', ['conteo_total' => $conteo_total])->to(Navbar::class);
            $this->alert('success', 'El producto fue agregado al carrito', [
                'position' => 'bottom-end',
                'timer' => 2000,
                'toast' => true,
                'timerProgressBar' => true,
                $this->skipRender()
            ]);
        } else {
            // Si se devuelve un mensaje de error
            $this->alert('error', $conteo_total, [
                'position' => 'bottom-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
                $this->skipRender()
            ]);
        }
    }


    public function render()
    {
        $this->marcas = Marca::all();
        $this->categorias = Categoria::inRandomOrder()->limit(4)->get();
        $this->productos = Producto::orderBy('en_oferta', 'desc')->limit(4)->get();
        return view('livewire.inicio-page');
    }
}
