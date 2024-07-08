<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Title;
use Livewire\Component;

class LoginPage extends Component
{
    public $email;
    public $password;

    #[Title('Inciciar Sesion')]
    public function save()
    {
        $this->validate([
           'email' => 'required|email|max:255|min:4|exists:users,email',
            'password' => 'required|min:4|max:300'
        ],
            [
                'email.required' => 'El campo correo electrónico es obligatorio.',
                'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
                'email.max' => 'El correo electrónico no puede tener más de 255 caracteres.',
                'email.exists' => 'Correo electrónico no encontrado.',
                'password.required' => 'El campo contraseña es obligatorio.',
                'password.string' => 'La contraseña debe ser una cadena de texto.',
                'password.max' => 'La contraseña no puede tener más de 30 caracteres.',
                'password.min' => 'La contraseña no puede tener menos de 4 caracteres.',
            ]
        );

        if (!auth()->attempt(['email'=>$this->email, 'password' => $this->password])){
            return redirect()->back()->with('error', 'Correo y contraseña no coinciden');
        }

        return redirect()->intended();

    }


    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
