<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" type="icon" href="assets/images/favicon.png" />
    <title>@yield('titulo')</title>
    @vite(['resources/css/app.css','resources/css/custom.css', 'resources/css/styles.css', 'resources/css/tailwind.css','resources/js/app.js',
    'resources/js/bootstrap.js', 'resources/js/script.js'])
    @livewireStyles

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/estilo/custom.css">
    <link rel="stylesheet" href="/css/estilo/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="node_modules/swiper/swiper-bundle.css">
</head>


<body>
<!-- Header -->
<header class="bg-gray-dark sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center py-4">
        <!-- Left section: Logo -->
        <a href="{{url('/inicio')}}" class="flex items-center">
            <div>
                <img src="/imagen/logo.jpeg" alt="Logo" width="50px" height="50px" class="rounded-2xl">
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
                <li><a href="{{ url('/categoria') }}" class="hover:text-cyan-500 font-semibold">Categorias</a></li>
                <li><a href="{{ url('/categoria') }}" class="hover:text-cyan-500 font-semibold">Marcas</a></li>
                <li><a href="{{ url('/producto-shop') }}" class="hover:text-cyan-500 font-semibold">Productos</a></li>
                <li><a href="{{ url('/categoria') }}" class="hover:text-cyan-500 font-semibold">Promociones</a></li>
                <li><a href="{{ url('/categoria') }}" class="hover:text-cyan-500 font-semibold">Descuentos</a></li>
                <li><a href="{{ url('/categoria') }}" class="hover:text-cyan-500 font-semibold">Cupones</a></li>
            </ul>
        </nav>


        <!-- Right section: Buttons (for desktop) -->
        <div class="hidden lg:flex items-center space-x-4 relative">
            <a href="{{ url('/registro') }}" class="bg-primary border border-primary text-white font-semibold px-4 py-2 rounded-full inline-block"
               style="background-color: #008b8b; border-color: #008b8b; color: white; transition: background-color 0.3s ease, color 0.3s ease;"
               onmouseover="this.style.backgroundColor='#005f5f'; this.style.color='#ffffff';"
               onmouseout="this.style.backgroundColor='#008b8b'; this.style.color='#ffffff';">
                Regístrate
            </a>

            <a href="{{ url('/login') }}" class="bg-primary border border-primary text-white font-semibold px-4 py-2 rounded-full inline-block"
               style="background-color: #008b8b; border-color: #008b8b; color: white; transition: background-color 0.3s ease, color 0.3s ease;"
               onmouseover="this.style.backgroundColor='#005f5f'; this.style.color='#ffffff';"
               onmouseout="this.style.backgroundColor='#008b8b'; this.style.color='#ffffff';">
                Iniciar Sesión
            </a>



        </div>
    </div>
</header>
<?php
use App\Models\Producto;

?>
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

<!-- Register and login -->
<div>

    @yield('contenido')




</div>

















<!-- Footer -->
<footer class="border-t border-gray-line">
    <!-- Top part -->
    <div class="container mx-auto px-4 py-10">
        <div class="flex flex-wrap -mx-4">
            <!-- Menu 1 -->
            <div class="w-full sm:w-1/6 px-4 mb-8">
                <h3 class="text-lg font-semibold mb-4">Shop</h3>
                <ul>
                    <li><a href="/shop.html" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Shop</a></li>
                    <li><a href="/single-product-page.html" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Women</a></li>
                    <li><a href="/shop.html" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Men</a></li>
                    <li><a href="/single-product-page.html" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Shoes</a></li>
                    <li><a href="/single-product-page.html" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Accessories</a></li>
                </ul>
            </div>
            <!-- Menu 2 -->
            <div class="w-full sm:w-1/6 px-4 mb-8">
                <h3 class="text-lg font-semibold mb-4">Paginas</h3>
                <ul>
                    <li><a href="/shop.html" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Categorias</a></li>
                    <li><a href="/single-product-page.html" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Marcas</a></li>
                    <li><a href="/checkout.html" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Productos</a></li>
                    <li><a href="/404.html" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Promociones</a></li>
                    <li><a href="/404.html" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Descuentos</a></li>
                    <li><a href="/404.html" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Cupones</a></li>
                </ul>
            </div>
            <!-- Menu 3 -->
            <div class="w-full sm:w-1/6 px-4 mb-8">
                <h3 class="text-lg font-semibold mb-4">Cuenta</h3>
                <ul>
                    <li><a href="/cart.html" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Carrito</a></li>
                    <li><a href="/register.html" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Registrarse</a></li>
                    <li><a href="/register.html" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Iniciar Sesión</a></li>
                </ul>
            </div>
            <!-- Social Media -->
            <div class="w-full sm:w-1/6 px-4 mb-8">
                <h3 class="text-lg font-semibold mb-4">Siguenos</h3>
                <ul>
                    <li class="flex items-center mb-2">
                        <i class="fab fa-facebook mr-2"></i><a href="#" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Facebook</a>
                    </li>
                    <li class="flex items-center mb-2">
                        <i class="fab fa-twitter mr-2"></i><a href="#" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Twitter</a>
                    </li>
                    <li class="flex items-center mb-2">
                        <i class="fab fa-instagram mr-2"></i><a href="#" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Instagram</a>
                    </li>
                    <li class="flex items-center mb-2">
                        <i class="fab fa-pinterest mr-2"></i><a href="#" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Pinterest</a>
                    </li>
                    <li class="flex items-center mb-2">
                        <i class="fab fa-youtube mr-2"></i><a href="#" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">YouTube</a>
                    </li>
                </ul>
            </div>




            <!-- Contact Information -->
            <div class="w-full sm:w-2/6 px-4 mb-8">
                <h3 class="text-lg font-semibold mb-4">Contactanos</h3>
                <div class="flex items-center mb-4">
                    <img src="/imagen/logo.jpeg" alt="Logo" width="80px" height="80px" class="rounded-2xl">
                    <p class="ml-4">Barrio El Carmelo, Frente al Marchante N°2, Danlí El Paraíso</p>
                </div>
                <p class="text-xl font-bold my-4">Telefono: +504 9326-5241</p>
                <a href="mailto:info@company.com" class="underline">Email: Abarrotes.Express@gmail.com</a>
            </div>

        </div>
    </div>

    <!-- Bottom part -->
    <div class="py-6 border-t border-gray-line">
        <div class="container mx-auto px-4 flex flex-wrap justify-between items-center">
            <!-- Copyright and Links -->
            <div class="w-full lg:w-3/4 text-center lg:text-left mb-4 lg:mb-0">
                <p class="mb-2 font-bold">&copy; 2024 Abarrotes Express. Todos los derechos reservados.</p>
                <ul class="flex justify-center lg:justify-start space-x-4 mb-4 lg:mb-0">
                    <li><a href="#" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Politicas de Privacidad</a></li>
                    <li><a href="#" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">Terminos del Servicio</a></li>
                    <li><a href="#" class="hover:text-cyan-500 hover:underline" style="transition: color 0.3s ease;">FAQ</a></li>
                </ul>
                <p class="text-sm mt-4">Tu tienda de abarrotes en línea, ofreciendo una amplia variedad de productos de calidad para tu conveniencia.</p>
            </div>

        </div>
    </div>
</footer>





</body>

</html>
