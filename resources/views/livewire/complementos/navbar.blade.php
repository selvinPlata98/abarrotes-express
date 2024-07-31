<div>
    <!-- Header -->
    <header class="bg-gray-dark sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center py-4">
            <!-- Left section: Logo -->
            <a href="{{url('/inicio')}}" class="flex items-center">
                <div>
                    <img src="/imagen/logo1.jpeg" alt="Logo" width="50px" height="50px" class="rounded-2xl">
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
                    <li><a href="{{ url('/producto-shop') }}" class="hover:text-cyan-500 font-semibold">Productos</a></li>
                    <li><a href="{{ url('/categorias') }}" class="hover:text-cyan-500 font-semibold">Promociones</a></li>
                    <li><a href="{{ url('/categorias') }}" class="hover:text-cyan-500 font-semibold">Descuentos</a></li>
                    <li><a href="{{ url('/categorias') }}" class="hover:text-cyan-500 font-semibold">Cupones</a></li>
                </ul>
            </nav>


            <!-- Right section: Buttons (for desktop) -->
            <div class="hidden lg:flex items-center space-x-4 relative">
                <a href="{{ url('/registro') }}" class="bg-primary border border-primary text-white font-semibold px-4 py-2 rounded-full inline-block">Regístrate</a>

                <a href="{{ url('/login') }}" class="bg-primary border border-primary text-white font-semibold px-4 py-2 rounded-full inline-block">Iniciar Sesión</a>
            </div>
        </div>
    </header>

    <!-- Mobile menu -->
    <nav id="mobile-menu-placeholder" class="mobile-menu hidden flex flex-col items-center space-y-8 lg:hidden">
        <ul class="w-full">
            <li><a href="index.html" class="hover:text-secondary font-bold block py-2">Home</a></li>

            <!-- Men Dropdown -->
            <li class="relative group" x-data="{ open: false }">
                <a @click="open = !open; $event.preventDefault()" class="hover:text-secondary font-bold block py-2 flex justify-center items-center cursor-pointer">
                    <span>Men</span>
                    <span @click.stop="open = !open">
                    <i :class="open ? 'fas fa-chevron-up text-xs ml-2' : 'fas fa-chevron-down text-xs ml-2'"></i>
                </span>
                </a>
                <ul class="mobile-dropdown-menu" x-show="open" x-transition class="space-y-2">
                    <li><a href="shop.html" class="hover:text-secondary font-bold block pt-2 pb-3">Shop Men</a></li>
                    <li><a href="single-product-page.html" class="hover:text-secondary font-bold block py-2">Men item 1</a></li>
                    <li><a href="single-product-page.html" class="hover:text-secondary font-bold block py-2">Men item 2</a></li>
                    <li><a href="single-product-page.html" class="hover:text-secondary font-bold block py-2">Men item 3</a></li>
                </ul>
            </li>

            <!-- Women Dropdown -->
            <li class="relative group" x-data="{ open: false }">
                <a @click="open = !open; $event.preventDefault()" class="hover:text-secondary font-bold block py-2 flex justify-center items-center cursor-pointer">
                    <span>Women</span>
                    <span @click.stop="open = !open">
                        <i :class="open ? 'fas fa-chevron-up text-xs ml-2' : 'fas fa-chevron-down text-xs ml-2'"></i>
                    </span>
                </a>
                <ul class="mobile-dropdown-menu" x-show="open" x-transition class="pl-4 space-y-2">
                    <li><a href="shop.html" class="hover:text-secondary font-bold block py-2">Shop Women</a></li>
                    <li><a href="single-product-page.html" class="hover:text-secondary font-bold block py-2">Women item 1</a></li>
                    <li><a href="single-product-page.html" class="hover:text-secondary font-bold block py-2">Women item 2</a></li>
                    <li><a href="single-product-page.html" class="hover:text-secondary font-bold block py-2">Women item 3</a></li>
                </ul>
            </li>

            <li><a href="shop.html" class="hover:text-secondary font-bold block py-2">Shop</a></li>
            <li><a href="single-product-page.html" class="hover:text-secondary font-bold block py-2">Product</a></li>
            <li><a href="404.html" class="hover:text-secondary font-bold block py-2">404 page</a></li>
            <li><a href="checkout.html" class="hover:text-secondary font-bold block py-2">Checkout</a></li>
        </ul>

        <!-- Search field -->
        <div
            class="  top-full right-0 mt-2 w-full bg-white shadow-lg p-2 rounded">
            <input type="text" class="w-full p-2 border border-gray-300 rounded"
                   placeholder="Search for products...">
        </div>
    </nav>
</div>
