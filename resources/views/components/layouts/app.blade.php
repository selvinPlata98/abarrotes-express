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
        <a href="index.html" class="flex items-center">
            <div>
                <img src="/imagen/logo.jpeg" alt="Logo" class="h-18 w-14 mr-7">
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
                <li><a href="index.html" class="hover:text-secondary font-semibold">Categoria</a></li>

                <!-- Men Dropdown -->
                <li class="relative group" x-data="{ open: false }">
                    <a href="shop.html" @mouseover="open = true" @mouseleave="open = false" href="#" class="hover:text-secondary font-semibold flex items-center">
                        Men
                        <i :class="open ? 'fas fa-chevron-up ml-1 text-xs' : 'fas fa-chevron-down ml-1 text-xs'"></i>
                    </a>
                    <ul
                        x-show="open"
                        @mouseover="open = true"
                        @mouseleave="open = false"
                        class="absolute left-0 bg-white text-black space-y-2 mt-1 p-2 rounded shadow-lg"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90"
                    >
                        <li><a href="shop.html" class="min-w-40 block px-4 py-2 hover:bg-primary hover:text-white rounded">Men Item 1</a></li>
                        <li><a href="shop.html" class="min-w-40 block px-4 py-2 hover:bg-primary hover:text-white rounded">Men Item 2</a></li>
                        <li><a href="shop.html" class="min-w-40 block px-4 py-2 hover:bg-primary hover:text-white rounded">Men Item 3</a></li>
                    </ul>
                </li>

                <!-- Women Dropdown -->
                <li class="relative group" x-data="{ open: false }">
                    <a href="shop.html" @mouseover="open = true" @mouseleave="open = false" href="#" class="hover:text-secondary font-semibold flex items-center">
                        Women
                        <i :class="open ? 'fas fa-chevron-up ml-1 text-xs' : 'fas fa-chevron-down ml-1 text-xs'"></i>
                    </a>
                    <ul
                        x-show="open"
                        @mouseover="open = true"
                        @mouseleave="open = false"
                        class="absolute left-0 bg-white text-black space-y-2 mt-1 p-2 rounded shadow-lg"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90"
                    >
                        <li><a href="shop.html" class="min-w-40 block px-4 py-2 hover:bg-primary hover:text-white rounded">Women Item 1</a></li>
                        <li><a href="shop.html" class="min-w-40 block px-4 py-2 hover:bg-primary hover:text-white rounded">Women Item 2</a></li>
                        <li><a href="shop.html" class="min-w-40 block px-4 py-2 hover:bg-primary hover:text-white rounded">Women Item 3</a></li>
                    </ul>
                </li>

                <li><a href="shop.html" class="hover:text-secondary font-semibold">Shop</a></li>
                <li><a href="single-product-page.html" class="hover:text-secondary font-semibold">Product</a></li>
                <li><a href="404.html" class="hover:text-secondary font-semibold">404 page</a></li>
                <li><a href="checkout.html" class="hover:text-secondary font-semibold">Checkout</a></li>
            </ul>
        </nav>

        <!-- Right section: Buttons (for desktop) -->
        <div class="hidden lg:flex items-center space-x-4 relative">
            <a href="register.html"
               class="bg-primary border border-primary hover:bg-transparent text-white hover:text-primary font-semibold px-4 py-2 rounded-full inline-block">Registro</a>
            <a href="register.html"
               class="bg-primary border border-primary hover:bg-transparent text-white hover:text-primary font-semibold px-4 py-2 rounded-full inline-block">login</a>
            <div class="relative group cart-wrapper">
                <a href="/cart.html" >
                    <img src="assets/images/cart-shopping.svg" alt="Cart" class="h-6 w-6 group-hover:scale-120">
                </a>
                <!-- Cart dropdown -->
                <div class="absolute right-0 mt-1 w-80 bg-white shadow-lg p-4 rounded hidden group-hover:block">
                    <div class="space-y-4">
                        <!-- product item -->
                        <div class="flex items-center justify-between pb-4 border-b border-gray-line">
                            <div class="flex items-center">
                                <img src="/assets/images/single-product/1.jpg" alt="Product" class="h-12 w-12 object-cover rounded mr-2">
                                <div>
                                    <p class="font-semibold">Summer black dress</p>
                                    <p class="text-sm">Quantity: 1</p>
                                </div>
                            </div>
                            <p class="font-semibold">$25.00</p>
                        </div>
                        <!-- product item -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="/assets/images/single-product/2.jpg" alt="Product" class="h-12 w-12 object-cover rounded mr-2">
                                <div>
                                    <p class="font-semibold">Black suit</p>
                                    <p class="text-sm">Quantity: 1</p>
                                </div>
                            </div>
                            <p class="font-semibold">$125.00</p>
                        </div>
                    </div>
                    <a href="/cart.html" class="block text-center mt-4 border border-primary bg-primary hover:bg-transparent text-white hover:text-primary py-2 rounded-full font-semibold">Go to Cart</a>
                </div>
            </div>
            <a id="search-icon" href="javascript:void(0);" class="text-white hover:text-secondary group">
                <img src="assets/images/search-icon.svg" alt="Search"
                     class="h-6 w-6 transition-transform transform group-hover:scale-120">
            </a>
            <!-- Search field -->
            <div id="search-field"
                 class="hidden absolute top-full right-0 mt-2 w-full bg-white shadow-lg p-2 rounded">
                <input type="text" class="w-full p-2 border border-gray-300 rounded"
                       placeholder="Search for products...">
            </div>
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
                    <li><a href="/shop.html" class="hover:text-primary">Shop</a></li>
                    <li><a href="/single-product-page.html" class="hover:text-primary">Women</a></li>
                    <li><a href="/shop.html" class="hover:text-primary">Men</a></li>
                    <li><a href="/single-product-page.html" class="hover:text-primary">Shoes</a></li>
                    <li><a href="/single-product-page.html" class="hover:text-primary">Accessories</a></li>
                </ul>
            </div>
            <!-- Menu 2 -->
            <div class="w-full sm:w-1/6 px-4 mb-8">
                <h3 class="text-lg font-semibold mb-4">Pages</h3>
                <ul>
                    <li><a href="/shop.html" class="hover:text-primary">Shop</a></li>
                    <li><a href="/single-product-page.html" class="hover:text-primary">Product</a></li>
                    <li><a href="/checkout.html" class="hover:text-primary">Checkout</a></li>
                    <li><a href="/404.html" class="hover:text-primary">404</a></li>
                </ul>
            </div>
            <!-- Menu 3 -->
            <div class="w-full sm:w-1/6 px-4 mb-8">
                <h3 class="text-lg font-semibold mb-4">Account</h3>
                <ul>
                    <li><a href="/cart.html" class="hover:text-primary">Cart</a></li>
                    <li><a href="/register.html" class="hover:text-primary">Registration</a></li>
                    <li><a href="/register.html" class="hover:text-primary">Login</a></li>
                </ul>
            </div>
            <!-- Social Media -->
            <div class="w-full sm:w-1/6 px-4 mb-8">
                <h3 class="text-lg font-semibold mb-4">Follow Us</h3>
                <ul>
                    <li class="flex items-center mb-2">
                        <a href="#" class="hover:text-primary">Facebook</a>
                    </li>
                    <li class="flex items-center mb-2">
                        <a href="#" class="hover:text-primary">Twitter</a>
                    </li>
                    <li class="flex items-center mb-2">
                        <a href="#" class="hover:text-primary">Instagram</a>
                    </li>
                    <li class="flex items-center mb-2">
                        <a href="#" class="hover:text-primary">Pinterest</a>
                    </li>
                    <li class="flex items-center mb-2">
                        <a href="#" class="hover:text-primary">YouTube</a>
                    </li>
                </ul>
            </div>
            <!-- Contact Information -->
            <div class="w-full sm:w-2/6 px-4 mb-8">
                <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                <p><img src="assets/images/template-logo.png" alt="Logo" class="h-[60px] mb-4"></p>
                <p>123 Street Name, Paris, France</p>
                <p class="text-xl font-bold my-4">Phone: (123) 456-7890</p>
                <a href="mailto:info@company.com" class="underline">Email: info@company.com</a>
            </div>
        </div>
    </div>

    <!-- Bottom part -->
    <div class="py-6 border-t border-gray-line">
        <div class="container mx-auto px-4 flex flex-wrap justify-between items-center">
            <!-- Copyright and Links -->
            <div class="w-full lg:w-3/4 text-center lg:text-left mb-4 lg:mb-0">
                <p class="mb-2 font-bold">&copy; 2024 Your Company. All rights reserved.</p>
                <ul class="flex justify-center lg:justify-start space-x-4 mb-4 lg:mb-0">
                    <li><a href="#" class="hover:text-primary">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-primary">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-primary">FAQ</a></li>
                </ul>
                <p class="text-sm mt-4">Your shop's description goes here. This is a brief introduction to your shop and what you offer.</p>
            </div>
            <!-- Payment Icons -->
            <div class="w-full lg:w-1/4 text-center lg:text-right">
                <img src="/assets/images/social_icons/paypal.svg" alt="PayPal" class="inline-block h-8 mr-2">
                <img src="/assets/images/social_icons/stripe.svg" alt="Stripe" class="inline-block h-8 mr-2">
                <img src="/assets/images/social_icons/visa.svg" alt="Visa" class="inline-block h-8">
            </div>
        </div>
    </div>
</footer>





</body>

</html>