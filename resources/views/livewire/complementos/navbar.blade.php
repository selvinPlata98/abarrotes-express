<div>
    <header class="bg-gray-dark sticky fixed top-0 z-50">
        <div class="container mx-auto flex justify-between items-center py-0">
            <!-- Left section: Logo -->
            <a href="{{route('inicio')}}" class="flex items-center">
                <div>
                    <img src="{{asset('imagen/logo1.jpeg')}}" alt="Logo" class="h-14 w-auto mr-4">
                </div>
            </a>

            <!-- Hamburger menu (for mobile) -->
            <div class="flex lg:hidden">
                <button id="hamburger" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

            <!-- Center section: Menu -->
            <nav class="hidden lg:flex md:flex-grow justify-center">
                <ul class="flex justify-center space-x-4 text-white">
                    <li><a href="{{ url('/categorias') }}" class="hover:text-cyan-500 font-semibold">Categorias</a></li>
                    <li><a href="{{ url('/marcas') }}" class="hover:text-cyan-500 font-semibold">Marcas</a></li>
                    <li><a href="{{ url('/productos') }}" class="hover:text-cyan-500 font-semibold">Productos</a></li>
                </ul>
            </nav>

            <div class="hidden lg:flex items-center space-x-4 relative">
                <!-- Right section: Buttons (for desktop) -->
                @guest
                    <div class="pt-3 md:pt-0 mt-auto mr-3">
                        <a wire:navigate
                           class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                           href="/login">
                            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            Iniciar Sesión
                        </a>
                    </div>
                @endguest

                @auth
                    
                @endauth
            </div>
            {{--Carrito--}}
            <a wire:navigate
               class="font-medium flex items-center text-white hover:text-primary py-3 md:py-6 ml-5"
               href="{{route('carrito')}}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path
                        d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z"/>
                </svg>

                <span class="">Carrito</span> <span
                    class="mx-4 py-0.5 px-1.5 rounded-full text-xs font-medium bg-blue-50 border border-blue-200 text-blue-600">{{$conteo_total}}</span>
            </a>
            <!-- /.end -->
        </div>
    </header>

    <!-- Mobile Menu -->
    <nav id="mobile-menu-placeholder" class="mobile-menu hidden flex flex-col items-center space-y-8 lg:hidden">
        <ul class="w-full">
            <li><a href="{{route('inicio')}}" class="hover:text-secondary font-bold block py-2">Inicio</a></li>
            <li><a href="{{ url('/categorias') }}" class="hover:text-cyan-500 font-semibold">Categorias</a></li>
            <li><a href="{{ url('/marcas') }}" class="hover:text-cyan-500 font-semibold">Marcas</a></li>
            <li><a href="{{ url('/productos') }}" class="hover:text-cyan-500 font-semibold">Productos</a></li>
        </ul>
        @guest
            <div class="flex flex-col mt-6 space-y-2 items-center">
                <a wire:navigate
                   class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                   href="{{route('login')}}">
                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                    Iniciar Sesión
                </a>

                <a wire:navigate
                   class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                   href="{{route('registro')}}">
                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z"/>
                    </svg>
                    Registro
                </a>
                @endguest
              
            </div>
    </nav>
</div>
<script>
    document.getElementById('hamburger').addEventListener('click', function () {
        const mobileMenu = document.getElementById('mobile-menu-placeholder');
        mobileMenu.classList.toggle('hidden');
    });

</script>