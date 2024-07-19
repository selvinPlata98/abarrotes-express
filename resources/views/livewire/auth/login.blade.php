<div class="bg-fondo min-h-screen flex justify-center items-center">
    <div class="max-w-md w-full p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-4 text-center">Iniciar Sesión ó Regístrate</h2>

        <form wire:submit.prevent="save">
            <div class="mb-4">
                <label for="login-email" class="block">Correo Electrónico</label>
                <input wire:model="email" type="email" id="login-email" class="input" placeholder="Ingrese su correo electrónico" required>
                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="login-password" class="block">Contraseña</label>
                <input wire:model="password" type="password" id="login-password" class="input" placeholder="Ingrese su contraseña" required>
                @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
                <div class="text-right mt-2">
                    <a href="#" class="text-sm text-primary hover:text-primary-dark">¿Olvidaste tu Contraseña?</a>
                </div>
            </div>
            @if (session()->has('error'))
                <div class="mb-4">
                    <span class="text-red-500">{{ session('error') }}</span>
                </div>
<<<<<<< HEAD
                @if (session()->has('error'))
                    <div class="mb-3">
                        <span class="text-red-500">{{ session('error') }}</span>
                    </div>
                @endif
                <button type="submit" 
                class="bg-primary text-white border border-primary hover:bg-transparent hover:text-primary py-2 px-3 rounded-full w-full" 
                style="background-color: #008b8b; border-color: #008b8b; transition: background-color 0.3s ease; color: white;" onmouseover="this.style.backgroundColor='#005f5f'; this.style.color='#ffffff';" onmouseout="this.style.backgroundColor='#008b8b'; this.style.color='#ffffff';">
                    Iniciar Sesión
                </button>
            </form>
            <p class="mt-4 text-sm">¿No tienes una cuenta? <a href="#" class="text-primary hover:text-primary-dark" style="color: #008b8b; hover:color: #005f5f;">Regístrate</a></p>
        </div>
=======
            @endif
            <button type="submit" class="btn w-full">
                Iniciar Sesión
            </button>
        </form>
        <p class="mt-4 text-sm text-center">¿No tienes una cuenta? <a href="#" class="text-primary hover:text-primary-dark">Regístrate</a></p>
>>>>>>> l_ortez
    </div>
</div>
