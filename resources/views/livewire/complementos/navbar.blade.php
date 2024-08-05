<div>
    <!-- Header -->
    <header class="bg-gray-dark sticky top-0 z-50 mb-3">
        <div class="fixed top-0 left-0 right-0 container mx-auto flex justify-between items-center py-4 bg-slate-700 h-16">
            <!-- Left section: Logo -->
            <a href="{{url('/inicio')}}" class="flex items-center flex-shrink-0">
                <div>
                    <img src="/imagen/logo1.jpeg" alt="Logo" width="50px" height="50px" class="rounded-2xl">
                </div>
            </a>

            <!-- Hamburger menu (for mobile) -->
            <div class="flex lg:hidden flex-shrink-0">
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
                    <li><a href="{{ url('/producto-shop') }}" class="hover:text-cyan-500 font-semibold">Productos</a></li>
                    {{--<li><a href="{{ url('/categorias') }}" class="hover:text-cyan-500 font-semibold">Promociones</a></li>
                    <li><a href="{{ url('/categorias') }}" class="hover:text-cyan-500 font-semibold">Descuentos</a></li>
                    <li><a href="{{ url('/categorias') }}" class="hover:text-cyan-500 font-semibold">Cupones</a></li>--}}
                </ul>
            </nav>

            <div class="flex justify-end flex-shrink-0">
                {{--Carrito--}}
                <a wire:navigate class="font-medium flex items-center text-gray-500 hover:text-gray-400 py-3 md:py-6 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="{{route('carrito')}}">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="mr-2 ml-2">Carrito</span> <span class="py-0.5 px-1.5 rounded-full text-xs font-medium bg-blue-50 border border-blue-200 text-blue-600">{{$conteo_total}}</span>
                </a>
                <!-- Right section: Buttons (for desktop) -->
                @guest
                    <div class="hidden lg:flex items-center space-x-4 relative">
                        <a href="{{ url('/registro') }}" class="bg-primary border border-primary text-white font-semibold px-4 py-2 rounded-full inline-block">Regístrate</a>
                        <a href="{{ url('/login') }}" class="bg-primary border border-primary text-white font-semibold px-4 py-2 rounded-full inline-block">Iniciar Sesión</a>
                    </div>
                @endguest

                @auth
                    @if(auth()->user()->hasRole(['Cliente']) == false)
                        <div class="hidden lg:flex items-center space-x-4 relative">
                            <a href="/admin" class="bg-primary border border-primary text-white font-semibold px-4 py-2 rounded-full inline-block">Ir al Panel Administrativo</a>
                        </div>
                        <div class="hidden lg:flex items-center space-x-4 relative">
                            <button class="bg-primary border border-primary text-white font-semibold px-4 py-2 rounded-full inline-block" wire:click="logout">Cerrar Sesión</button>
                        </div>
                    @else
                        <div class="hidden lg:flex items-center space-x-4 relative">
                            <button class="bg-primary border border-primary text-white font-semibold px-4 py-2 rounded-full inline-block" wire:click="logout">Cerrar Sesión</button>
                        </div>
                    @endif
                @endauth
            </div>
            <!-- /.end -->

        </div>
    </header>

    <!-- Mobile menu -->
    <nav id="mobile-menu-placeholder" class="mobile-menu hidden flex flex-col items-center space-y-8 lg:hidden">
        <ul class="w-full">
            <li><a href="{{route('inicio')}}" class="hover:text-secondary font-bold block py-2">Inicio</a></li>

            <!-- Men Dropdown -->
            <li class="relative group" x-data="{ open: false }">
                <a @click="open = !open; $event.preventDefault()" class="hover:text-secondary font-bold block py-2 flex justify-center items-center cursor-pointer">
                    <span>Tienda</span>
                    <span @click.stop="open = !open">
                    <i :class="open ? 'fas fa-chevron-up text-xs ml-2' : 'fas fa-chevron-down text-xs ml-2'"></i>
                </span>
                </a>
                <ul class="mobile-dropdown-menu" x-show="open" x-transition class="space-y-2">
                    <li><a href="#" class="hover:text-secondary font-bold block pt-2 pb-3">Productos</a></li>
                    <li><a href="#" class="hover:text-secondary font-bold block py-2">Categorías</a></li>
                    <li><a href="#" class="hover:text-secondary font-bold block py-2">Marcas</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
