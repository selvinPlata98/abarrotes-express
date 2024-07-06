<div>
<form method="post" wire:submit.prevent="guardar" >
       <h1>Registro</h1>
       <div>
       @if (session()->has('mensaje'))
            <div class="mensaje-exito">
                {{ session('mensaje') }}
            </div>
        @endif
       <label for="" >Nombre </label><br>
       <input wire:model="name" type="text" name="name" id="name"><br>
       @error('name')
            <div class="mensaje-error">{{ $message }}</div>
        @enderror


       <label for="">Correo</label><br>
       <input wire:model="email" type="email" name="email" id="email"><br>
       @error('email')
            <div class="mensaje-error">{{ $message }}</div>
        @enderror



       <label for="" class="text-red-500" >Contraseña</label><br >
       <input wire:model="password" type="password" name="password" id="password"><br>
       @error('password')
            <div class="mensaje-error">{{ $message }}</div>
        @enderror

        <div>
       <input type="submit" value="Guardar">
       </div>
       </div>
</div>