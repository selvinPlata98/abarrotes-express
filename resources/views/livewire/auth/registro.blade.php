<div style="background-image: url('imagen/Fondo2-n4hFGeXP0-transformed.jpeg'); background-size: cover; background-position: center;">
<div class="flex justify-center items-center h-screen">
        <div class="bg-white rounded-lg shadow-md p-4 md:p-10 mt-5 mb-5" style="width: 550px; min-height: 400px; margin: auto;">
            <h2 class="text-2xl font-semibold mb-4 text-center">Registro</h2>

            <form method="post" wire:submit.prevent="guardar">
            <div class="mb-3">
                    <label for="name" class="block">Nombre de Usuario</label>
                    <input wire:model="name" type="name" id="register-email" class="w-full px-3 py-1 border focus:border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-primary"  placeholder="Ingrese un nombre de usuario" required>
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="block">Correo Electrónico</label>
                    <input wire:model="email" type="email" id="login-email" class="w-full px-3 py-1 border focus:border-cyan-500 rounded-full focus:outline-none focus:ring-2 focus:ring-cyan-500" placeholder="Ingrese su correo electrónico" required>
                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="login-password" class="block">Contraseña</label>
                    <input wire:model="password" type="password" id="login-password" class="w-full px-3 py-1 border focus:border-cyan-500 rounded-full focus:outline-none focus:ring-2 focus:ring-cyan-500" placeholder="Ingrese su contraseña" required>
                    @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
                    <br>
                </div>
                
                <button type="submit" 
                class="bg-primary text-white border border-primary hover:bg-transparent hover:text-primary py-2 px-3 rounded-full w-full" 
                style="background-color: #008b8b; border-color: #008b8b; transition: background-color 0.3s ease; color: white;" onmouseover="this.style.backgroundColor='#005f5f'; this.style.color='#ffffff';" onmouseout="this.style.backgroundColor='#008b8b'; this.style.color='#ffffff';">
                    registrar
                </button>
            </form>
        </div>
    </div>
    

</div>
