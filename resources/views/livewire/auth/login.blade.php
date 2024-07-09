<div>
    <div class="flex justify-center items-center h-screen">
        <div class="md:w-1/2 bg-white rounded-lg shadow-md p-4 md:p-10">
            <h2 class="text-2xl font-semibold mb-4">Iniciar Sesión</h2>
            <form wire:submit.prevent="save">
                <div class="mb-3">
                    <label for="login-email" class="block">Correo Electrónico</label>
                    <input wire:model="email" type="email" id="login-email" class="w-full px-3 py-1 border focus:border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-primary" required>
                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="login-password" class="block">Contraseña</label>
                    <input wire:model="password" type="password" id="login-password" class="w-full px-3 py-1 border focus:border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-primary" required>
                    @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                @if (session()->has('error'))
                    <div class="mb-3">
                        <span class="text-red-500">{{ session('error') }}</span>
                    </div>
                @endif
                <button type="submit" class="bg-primary text-white border border-primary hover:bg-transparent hover:text-primary py-2 px-3 rounded-full w-full">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</div>