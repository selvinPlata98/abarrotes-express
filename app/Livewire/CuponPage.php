<?php

namespace App\Livewire;

use App\Models\Cupon;
use Livewire\Component;

class CuponPage extends Component
{
    public $perPage = 9;


    public function render()
    {
        $cupones = Cupon::where('estado', 1)->paginate($this->perPage);

        return view('livewire.cupon-page', [
            'cupones' => $cupones,
        ]);
    }
}
