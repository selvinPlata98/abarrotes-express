<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class Registro extends Component
{

    public $id;
    public $name;
    public $email;
    public $password;
    public $email_verified_at;
    public $user;

    public function render()
    {
        return view('livewire.auth.registro');
    }



    public function guardar(){

        if (empty($this->name)) {
            $this->addError('name', 'El campo nombre es requerido');
        }

        if (empty($this->email)) {
            $this->addError('email', 'El campo correo es requerido');
        }

        // Resto de las validaciones..


        $this->validate([
            'name' => 'required|regex:/^[a-zA-Z0-9_ áéíóúñ]+$/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        // Crear un nuevo registro en la base de datosssss
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->email_verified_at = Carbon::now();
        $user->save();

        $this->reset();

        // Mostrar un mensaje de éxito
        session()->flash('mensaje', '¡Registro exitoso!');

        return redirect()->to('/inicio');
    }
}
