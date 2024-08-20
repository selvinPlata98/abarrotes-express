<?php

namespace App\Livewire\Complementos;

use App\Helpers\CarritoManagement;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $conteo_total = 0;

    public function mount(){
        $this->conteo_total = count(CarritoManagement::obtenerElementosDeCookies());
    }

    #[On('update-cart-count')]
    public function updateCartCount($conteo_total)
    {
        $this->conteo_total = $conteo_total['conteo_total'] ?? 0; // Asigna 0 si el valor no está presente
    }


    public function logout()
    {
        \Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.complementos.navbar');
    }
}
