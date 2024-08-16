<?php

namespace App\Livewire;

use Livewire\Component;

class CuponPage extends Component
{
    
public $coupons = [
    ['code' => 'Descuento', 'description' => '10% En ordenes lps1000'],
    ['code' => 'Envio Gratis', 'description' => 'Envio Gratis lps1000'],
    ['code' => 'Condicion', 'description' => 'Compra Minima lps2000'],
];
       
    public function render()
    {
        return view('livewire.cupon-page');
    }
}
