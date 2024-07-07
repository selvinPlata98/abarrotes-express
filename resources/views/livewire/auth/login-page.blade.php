<div>
    <section id="register-login-page" class="bg-white py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="md:w-1/2 bg-white rounded-lg shadow-md p-4 md:p-10 md:m-10">
                    <h2 class="text-2xl font-semibold mb-4">Login</h2>
                    <form wire:submit.prevent="save">

                        @if(session('error'))
                            <div class="text-center mb-4 mt-2 bg-red-500 text-sm text-white rounded-lg p-4" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="login-email" class="block ">Email</label>
                            <input wire:model="email" type="email" id="login-email" class="w-full px-3 py-1 border  rounded-full focus:border-transparent focus:outline-none focus:ring-2 focus:ring-primary" required>

                            @error('email')
                            <p class="text-xs text-red-600 mt-2" id="password-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="login-password" class="block ">Password</label>
                            <input wire:model="password" type="password" id="login-password" class="w-full px-3 py-1 border  rounded-full focus:border-transparent focus:outline-none focus:ring-2 focus:ring-primary" required>
                            @error('password')
                            <p class="text-xs text-red-600 mt-2" id="password-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="bg-primary text-white border border-primary hover:bg-transparent hover:text-primary py-2 px-3 rounded-full w-full">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
