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

        $this->validate([
            'name' => 'required|regex:/^[a-zA-Z0-9_ áéíóúñ]+$/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:18'
        ],
            [
                'name.required' => 'El nombre de usuario es obligatorio.',
                'email.required' => 'El campo correo electrónico es obligatorio.',
                'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
                'email.max' => 'El correo electrónico no puede tener más de 255 caracteres.',
                'email.unique' => 'Correo electrónico ya existe.',
                'password.required' => 'El campo contraseña es obligatorio.',
                'password.max' => 'La contraseña no puede tener más 18 caracteres.',
                'password.min' => 'La contraseña no puede tener menos de 8 caracteres.',
            ]
        );


       /* $this->validate([
            'name' => 'required|regex:/^[a-zA-Z0-9_ áéíóúñ]+$/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:18',
        ]);*/
    
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

        return redirect()->to('/');
    }
}
