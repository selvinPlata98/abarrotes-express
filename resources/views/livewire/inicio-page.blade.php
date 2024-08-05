<div>

    <section id="product-slider">
        <div class="main-slider swiper-container">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <img src="/imagen/BannerAbarrotesExpress.jpg" alt="Product 1">
                </div>


                <section id="brands" class="bg-white py-16 px-4">
                    <div class="container mx-auto max-w-screen-xl px-4 testimonials">
                        <div class="text-center mb-12 lg:mb-20">
                            <h2 class="text-5xl font-bold mb-4"><span class="text-primary">Nuestros Productos</span>
                            </h2>
                            <p class="my-7">¡Descubre nuestros increíbles productos! Sumérgete en una experiencia única
                                y encuentra todo lo que necesitas en un solo lugar.</p>

                        </div>


                        <!-- Traer los productos de la base de datos -->
                        <div class="flex flex-wrap -mx-4">
                            @forelse ($producto as $productos)
                                @if($productos->en_oferta > 0)
                                    <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 xl:w-1/4 px-4 mb-8">
                                        <div class="bg-white p-3 rounded-lg shadow-lg text-center">
                                            @if(isset($productos->imagenes) && count($productos->imagenes) > 0)
                                                <img src="{{ url('storage/' , $productos->imagenes[0]) }}"
                                                     class="w-full object-cover mb-4 rounded-lg tamanoCard"
                                                     alt="{{$productos->imagenes[0]}}">
                                            @endif
                                            <a href="producto/{{$productos->enlace}}"
                                               class="text-lg font-semibold mb-2">{{$productos->nombre}}</a>
                                            <div class="flex items-center mb-4">
                                                <span
                                                    class="text-lg font-bold text-primary">{{$productos->precio - $productos->en_oferta}}</span>
                                                <span class="text-sm line-through ml-2">{{$productos->precio}}</span>
                                            </div>
                                            <button wire:click.prevent='agregarCarrito({{$productos ->id }})'
                                                class="bg-primary text-white border border-primary hover:bg-transparent hover:text-primary py-2 px-3 rounded-full w-full">
                                                Añadir al carrito
                                            </button>
                                        </div>
                                    </div>
                                @else
                                    <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 xl:w-1/3 px-4 mb-8">
                                        <div class="bg-white p-3 rounded-lg shadow-lg text-center">
                                            @if(isset($productos->imagenes) && count($productos->imagenes) > 0)
                                                <img src="{{ url('storage/' , $productos->imagenes[0]) }}"
                                                     class="w-full object-cover mb-4 rounded-lg tamanoCard"
                                                     alt="{{$productos->imagenes[0]}}">
                                            @endif
                                            <a href="producto/{{$productos->enlace}}"
                                               class="text-lg font-semibold mb-2">{{$productos->nombre}}</a>
                                            <div class="flex items-center mb-4">
                                                <span
                                                    class="text-lg font-bold text-primary">{{$productos->precio }}</span>
                                            </div>
                                                <button
                                                    class="bg-primary text-white border border-primary hover:bg-transparent hover:text-primary py-2 px-3 rounded-full w-full">
                                                Añadir al carrito
                                            </button>
                                        </div>
                                    </div>
                                @endif

                                @endforeach


                        </div>

                        <section id="brands" class="bg-white py-16 px-4">
                            <div class="container mx-auto max-w-screen-xl px-4 testimonials">
                                <div class="text-center mb-12 lg:mb-20">
                                    <h2 class="text-5xl font-bold mb-4">Descubra <span class="text-primary">Nuestras Categorias</span>
                                    </h2>
                                    <p class="my-7">Descubre las principales categorías que ofrecemos en nuestra tienda
                                        y explora todo lo que tenemos para ti.</p>
                                </div>


                                <!-- Traer los categoria de la base de datos -->
                                <div class="flex flex-wrap -mx-4">
                                    @forelse ($categoria as $categorias)
                                        <div class="w-full sm:w-1/2 md:w-1/4 lg:w-1/4 xl:w-1/4 px-4 mb-8">
                                            <div class="bg-white p-3 rounded-lg shadow-lg">


                                                <img src="{{url('storage' , $categorias->imagen)}}"
                                                     class="w-full object-cover mb-4 rounded-lg tamanoCard"
                                                     alt="{{$categorias->imagen}}">
                                                <a href="#"
                                                   class="text-lg font-semibold mb-2">{{$categorias->nombre}}</a>
                                            </div>


                                        </div>
                                    @empty
                                        <p>No se encontraron categorías.</p>
                            @endforelse


                        </section>

                        <section id="brands" class="bg-white py-16 px-4">
                            <div class="container mx-auto max-w-screen-xl px-4 testimonials">
                                <div class="text-center mb-12 lg:mb-20">
                                    <h2 class="text-5xl font-bold mb-4">Descubra <span class="text-primary">Nuestras Marcas</span>
                                    </h2>
                                    <p class="my-7">Explora las principales marcas que presentamos en nuestra tienda</p>
                                </div>
                                <div class="flex flex-wrap -mx-4">
                                    @forelse ($marca as $marcas)
                                        <div class="w-full sm:w-1/2 md:w-1/4 lg:w-1/4 xl:w-1/4 px-4 mb-8">
                                            <div class="bg-white p-3 rounded-lg shadow-lg">

                                                <img src="{{ url('storage' , $marcas->imagen) }}"
                                                     class="w-full object-cover mb-4 rounded-lg tamanoCard"
                                                     alt="{{$marcas->imagen}}">
                                                <a href="#" class="text-lg font-semibold mb-2">{{$marcas -> nombre}}</a>
                                            </div>
                                        </div>
                                    @empty
                                        <p>No se encontraron las marcas.</p>
                            @endforelse


                        </section>


                        <section class="py-16">
                            <div class="relative items-center w-full px-5 py-12 mx-auto md:px-12 lg:px-24 max-w-7xl">
                                <div class="grid w-full grid-cols-1 gap-6 mx-auto lg:grid-cols-3">
                                    <div class="flex flex-col p-6 bg-white rounded-xl shadow-lg">
                                        <h1 class="mb-4 text-2xl font-semibold leading-none tracking-tighter text-gray-dark lg:text-3xl">
                                            Compra 100% segura.</h1>
                                        <p class="flex-grow text-base font-medium leading-relaxed text-gray-txt">Compra
                                            con confianza en abarrotes-express, tu tienda en línea donde garantizamos
                                            una experiencia satifatoria</p>
                                        <img class="object-cover object-center w-full mb-8 rounded-xl"
                                             src="/imagen/segurida.png" alt="blog">

                                    </div>
                                    <div class="flex flex-col p-6 bg-white rounded-xl shadow-lg">
                                        <h1 class="mb-4 text-2xl font-semibold leading-none tracking-tighter text-gray-dark lg:text-3xl">
                                            Metodo de pago</h1>
                                        <p class="flex-grow text-base font-medium leading-relaxed text-gray-txt">
                                            Aceptamos pagos únicamente con tarjeta de crédito o débito! Puedes realizar
                                            tus compras de manera segura y conveniente utilizando cualquiera de estas
                                            dos opciones de pago.</p>
                                        <img class="object-cover object-center w-full mb-8 rounded-xl"
                                             src="imagen/tarjeta.png" alt="blog">
                                    </div>
                                    <div class="flex flex-col p-6 bg-white rounded-xl shadow-lg">
                                        <h1 class="mb-4 text-2xl font-semibold leading-none tracking-tighter text-gray-dark lg:text-3xl">
                                            Recibe tu producto</h1>
                                        <p class="flex-grow text-base font-medium leading-relaxed text-gray-txt">
                                            Coordina la entrega de tu compra directamente con el vendedor. Tienes la
                                            opción de recibirlo cómodamente en tu domicilio, en la oficina o elegir
                                            recogerlo personalmente. ¡Tú tienes la libertad de decidir lo que más te
                                            convenga!.</p>
                                        <img class="object-cover object-center w-full mb-8 rounded-xl"
                                             src="imagen/envioo.png" alt="blog">
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>
