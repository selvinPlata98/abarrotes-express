<div>
    <div class="flex justify-center items-center h-screen">
       <div class="md:w-1/2 bg-white rounded-lg shadow-md p-4 md:p-10 ">

       <h2 class="text-2xl font-semibold mb-4">Registro</h2>
                    <form method="post" wire:submit.prevent="guardar" >
                    <div class="mb-3">
                            <label for="Nombre de usuario" class="block ">Nombre de usuario</label>
                            <input wire:model="name" type="name" id="register-email" class="w-full px-3 py-1 border focus:border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-primary" required>
                        </div>
                        <div class="mb-3">
                            <label for="register-email" class="block ">correo</label>
                            <input wire:model="email" type="email" id="register-email" class="w-full px-3 py-1 border focus:border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-primary" required>
                        </div>
                        <div class="mb-3">
                            <label for="register-password" class="block ">Contraseña</label>
                            <input wire:model="password" type="password" id="register-password" class="w-full px-3 py-1 border focus:border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-primary" required>
                        </div>
                        <button type="submit" class="bg-primary text-red border border-primary hover:bg-transparent hover:text-primary py-2 px-3 rounded-full w-full">Registra</button>
                    </form>
          </div>
  </div>
</div>
