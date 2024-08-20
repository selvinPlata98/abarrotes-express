<?php

namespace App\Livewire;

use App\Helpers\CarritoManagement;
use App\Livewire\Complementos\Navbar;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;


class CarritoPage extends Component
{
    use LivewireAlert;
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
        $this->dispatch('update-cart-count', conteo_total: count($this->elementos_carrito))->to(Navbar::class);
    }


    public function incrementarCantidad($producto_id)
    {
        $resultado = CarritoManagement::incrementarCantidadElementosCarrito($producto_id);

        if (is_array($resultado)) {
            $this->elementos_carrito = $resultado;
            $this->total_final = CarritoManagement::calcularTotalFinal($this->elementos_carrito);
        } else {
            // Muestra una alerta si hay un error, por ejemplo, si se excede la cantidad disponible
            $this->alert('error', $resultado, [
                'position' => 'bottom-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
                $this->skipRender()
            ]);
        }
    }


    public function decrementarCantidad($producto_id)
    {
        $this->elementos_carrito = CarritoManagement::decrementarCantidadElementosCarrito($producto_id);
        $this->total_final = CarritoManagement::calcularTotalFinal($this->elementos_carrito);
    }


    public function render()
    {
        return view('livewire.carrito-page');
    }
}
