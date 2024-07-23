<?php

namespace App\Livewire\Complementos;

use App\Models\User;
use Livewire\Component;

class Navbar extends Component
{

    public function logout()
    {
        \Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    }
    public function render()
    {
      if (auth()->check() && auth()->user()->is_admin){
          return view('livewire.complementos.navbar');
      }
        return view('livewire.complementos.navbar');
    }
}
