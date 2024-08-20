<div>
    <!-- Breadcrumbs -->
    <section id="breadcrumbs" class="pt-6 bg-gray-50">
        <div class="container mx-auto px-4 justify-items-center">
            <ol class="list-reset flex">
                <li><a href="{{route('inicio')}}" class="font-semibold hover:text-primary">Inicio</a></li>
                <li><span class="mx-2">&gt;</span></li>
                <li><a href="{{route('inicio')}}" class="font-semibold hover:text-primary">Productos</a></li>
                <li><span class="mx-2">&gt;</span></li>
                <li><a href="/categorias/{{$producto ->categoria->enlace}}" class="font-semibold hover:text-primary">{{$producto ->categoria->nombre}}</a></li>
                <li><span class="mx-2">&gt;</span></li>
                <li>{{$producto->nombre}}</li>
            </ol>
        </div>
    </section>

    <!-- Product info -->
    <section id="product-info">
        <div class="container mx-auto">
            <div class="py-6">
                <div class="flex flex-col lg:flex-row gap-6">
                    <!-- Image Section -->
                    <div class="w-full lg:w-1/2">
                        <div class="grid gap-4">
                            <!-- Big Image -->
                            <div id="main-image-container">
                                <img id="main-image"
                                     class="h-auto w-full max-w-full rounded-lg object-cover object-center md:h-[480px] transition-transform duration-300 ease-in-out transform hover:scale-105"
                                     src="{{url('storage', $producto->imagenes[0])}}"
                                     alt="{{$producto -> nombre}}" />
                            </div>
                            <!-- Small Images -->
                            <div class="grid grid-cols-5 gap-4">
                                @foreach($producto -> imagenes as $imagen)
                                    <img onclick="changeImage(this)"
                                         data-full="{{url('storage', $imagen)}}"
                                         src="{{url('storage', $imagen)}}"
                                         class="object-cover object-center max-h-30 max-w-full rounded-lg cursor-pointer border-2 border-transparent hover:border-primary transition-shadow duration-300 ease-in-out shadow-sm hover:shadow-lg"
                                         alt="{{$producto -> nombre}}" />
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Product Details Section -->
                    <div class="w-full lg:w-1/2 flex flex-col justify-between">
                        <div class="pb-8 border-b border-gray-line">
                            <h1 class="text-5xl font-bold mb-4">{{$producto ->nombre}}</h1>
                            <div class="mb-4 pb-4 border-b border-gray-line place-self-end">
                                <p class="mb-2 text-3xl">Marca: <strong><a href="#" class="hover:text-primary">{{$producto ->marca->nombre}}</a></strong></p>
                                <p class="mb-2 text-3xl">Categoría: <strong><a href="#" class="hover:text-primary">{{$producto ->categoria -> nombre}}</a></strong></p>
                                <p class="mb-2 text-2xl">Código de Producto: <strong>00000</strong></p>
                                <p class="mb-2 text-2xl">Disponible:
                                    @if($producto->disponible == true)
                                        <strong>Sí</strong>
                                    @else
                                        <strong>No</strong>
                                    @endif
                                </p>
                            </div>
                            <div class="text-2xl font-semibold mb-8 text-4xl">{{Number::currency($producto ->precio, 'lps')}}</div>
                            <div class="flex items-center mb-8">
                                <button id="decrease" class="bg-primary hover:bg-transparent border border-transparent hover:border-primary text-white hover:text-primary font-semibold w-10 h-10 rounded-full flex items-center justify-center focus:outline-none" disabled>-</button>
                                <input id="quantity" type="number" value="1" class="w-16 py-2 text-center focus:outline-none text-2xl" readonly>
                                <button id="increase" class="bg-primary hover:bg-transparent border border-transparent hover:border-primary text-white hover:text-primary font-semibold w-10 h-10 rounded-full focus:outline-none">+</button>
                            </div>
                            <button class="bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full text-2xl">Agregar al Carrito</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function changeImage(element) {
        const mainImage = document.getElementById('main-image');
        mainImage.src = element.getAttribute('data-full');
    }
</script>
