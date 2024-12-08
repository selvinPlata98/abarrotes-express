<?php

namespace App\Livewire;

use App\Helpers\CarritoManagement;
use App\Livewire\Complementos\Navbar;
use Livewire\Attributes\Title;
use Livewire\Component;

class CarritoPage extends Component
{
    #[Title('Carrito')]
    public $elementos_carrito;
    public $total_final;
    public function mount()
    {
        $this->elementos_carrito = CarritoManagement::obtenerElementosDeCookies();
        $this->total_final = CarritoManagement::calcularTotalFinal($this->elementos_carrito);
    }

    public function eliminarElemento($producto_id)
    {
        $this->elementos_carrito = CarritoManagement::quitarElementosCarrito($producto_id);
        $this->total_final = CarritoManagement::calcularTotalFinal($this->elementos_carrito);
        $this->dispatch('update-cart-count', total_count: count($this->elementos_carrito))->to(Navbar::class);
    }

    function increaseQty($producto_id)
    {
        $this->elementos_carrito = CarritoManagement::incrementarCantidadElementosCarrito($producto_id);
        $this->total_final = CarritoManagement::calcularTotalFinal($this->elementos_carrito);
    }

    function decreaseQty($producto_id)
    {
        $this->elementos_carrito = CarritoManagement::decrementarCantidadElementosCarrito($producto_id);
        $this->total_final = CarritoManagement::calcularTotalFinal($this->elementos_carrito);
    }

    public function render()
    {
        return view('livewire.carrito-page');
    }
}
