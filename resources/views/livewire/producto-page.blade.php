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
                                     class="h-auto w-full max-w-full rounded-lg object-cover object-center md:h-[480px]"
                                     src="{{url('storage', $producto->imagenes[0])}}"
                                     alt="{{$producto -> nombre}}" />
                            </div>
                            <!-- Small Images -->
                            <div class="grid grid-cols-5 gap-4">
                                <div>
                                    @foreach($producto  -> imagenes as $imagen)
                                        <img onclick="changeImage(this)"
                                             data-full="{{url('storage', $imagen)}}"
                                             src="{{url('storage', $imagen)}}" class="object-cover object-center max-h-30 max-w-full rounded-lg cursor-pointer" alt="{{$producto -> nombre}}"/>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product Details Section -->
                    <div class="w-full lg:w-1/2 flex flex-col justify-between">
                        <div class="pb-8 border-b border-gray-line">
                            <h1 class="text-5xl font-bold mb-4">{{$producto ->nombre}}</h1>
                            <div class="mb-4 pb-4 border-b border-gray-line place-self-end">
                                <p class="mb-2 text-3xl">Marca:<strong><a href="#" class="hover:text-primary"> {{$producto ->marca->nombre}}</a></strong>
                                </p>
                                <p class="mb-2 text-3xl">Categoría:<strong><a href="#" class="hover:text-primary"> {{$producto ->categoria -> nombre}}</a></strong>
                                </p>

                                <p class="mb-2 text-2xl">Código de Producto:<strong> 00000</strong></p>
                                <p class="mb-2 text-2xl">Disponible:
                                    @if($producto->disponible == true) <strong>Sí</strong>
                                    @else
                                        <strong>No</strong>
                                    @endif</p>
                            </div>
                            <div class="text-2xl font-semibold mb-8 text-4xl">{{Number::currency($producto ->precio, 'lps')}}</div>
                            <div class="flex items-center mb-8">
                                <button id="decrease"
                                        class="bg-primary hover:bg-transparent border border-transparent hover:border-primary text-white hover:text-primary font-semibold w-10 h-10 rounded-full flex items-center justify-center focus:outline-none"
                                        disabled>-</button>
                                <input id="quantity" type="number" value="1"
                                       class="w-16 py-2 text-center focus:outline-none text-2xl " readonly>
                                <button id="increase"
                                        class="bg-primary hover:bg-transparent border border-transparent hover:border-primary text-white hover:text-primary font-semibold  w-10 h-10 rounded-full focus:outline-none">+</button>
                            </div>
                            <button
                                class="bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full text-2xl">Agregar al Carrito</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product tabs description -->
    <section>
        <div class="container mx-auto">
            <div class="py-4">
                <div class="mt-1">
                    <div class="flex justify-center" role="tablist">
                        <button id="description-tab" role="tab" aria-controls="description-content" aria-selected="true"
                                class="tab active">Descripción</button>
                        <button id="reviews-tab" role="tab" aria-controls="reviews-content" aria-selected="false"
                                class="tab">Reseñas (3)</button>
                    </div>
                    <div class="mt-8">
                        <div id="description-content" role="tabpanel" aria-labelledby="description-tab"
                             class="tab-content">
                            <div class="flex flex-col lg:flex-row lg:space-x-8">
                                <div class="w-full">
                                    <p class="mb-4">{{$producto -> descripcion}}</p>
                                </div>
                            </div>
                        </div>
                        <div id="reviews-content" role="tabpanel" aria-labelledby="reviews-tab"
                             class="tab-content hidden">
                            <!-- Reviews List -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-semibold mb-4">Customer Reviews</h3>
                                <div id="reviews-list">
                                    <!-- Review 1 -->
                                    <div class="py-4">
                                        <div class="flex items-center mb-2">
                                            <span class="text-lg font-semibold text-gray-700">John Doe</span>
                                            <span class="ml-2 text-primary">★★★★★</span>
                                        </div>
                                        <p>Great quality! Fits perfectly and the material feels premium. Highly
                                            recommend this t-shirt.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Review Form -->
                            <div class="mt-8">
                                <h3 class="text-lg font-semibold mb-4">Write a Review</h3>
                                <form id="review-form" class="space-y-4">
                                    <div class="space-y-4 md:flex md:space-x-4 md:space-y-0">
                                        <div class="md:flex-1">
                                            <label for="review-name"
                                                   class="block text-sm font-medium text-gray-700">Name</label>
                                            <input type="text" id="review-name" name="review-name"
                                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                        </div>
                                        <div class="md:flex-1">
                                            <label for="review-email"
                                                   class="block text-sm font-medium text-gray-700">Email</label>
                                            <input type="email" id="review-email" name="review-email"
                                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                        </div>
                                        <div class="md:flex-1">
                                            <label for="review-rating"
                                                   class="block text-sm font-medium text-gray-700">Rating</label>
                                            <select id="review-rating" name="review-rating"
                                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                                <option value="5">★★★★★</option>
                                                <option value="4">★★★★☆</option>
                                                <option value="3">★★★☆☆</option>
                                                <option value="2">★★☆☆☆</option>
                                                <option value="1">★☆☆☆☆</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="review-text"
                                               class="block text-sm font-medium text-gray-700">Review</label>
                                        <textarea id="review-text" name="review-text" rows="4"
                                                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"></textarea>
                                    </div>
                                    <div>
                                        <button type="submit"
                                                class="bg-primary hover:bg-transparent border border-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full focus:outline-none">Submit
                                            Review</button>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest-products -->
    <section id="latest-products" class="py-10">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold mb-8">Latest products</h2>
            <div class="flex flex-wrap -mx-4">
                <!-- Product 1 -->
                <div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-8">
                    <div class="bg-white p-3 rounded-lg shadow-lg">
                        <img src="assets/images/products/5.jpg" alt="Product 1" class="w-full object-cover mb-4 rounded-lg">
                        <a href="#" class="text-lg font-semibold mb-2">Blue women's suit</a>
                        <p class=" my-2">Women</p>
                        <div class="flex items-center mb-4">
                            <span class="text-lg font-bold text-primary">$19.99</span>
                            <span class="text-sm line-through ml-2">$24.99</span>
                        </div>
                        <button class="bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full w-full">Add to Cart</button>
                    </div>
                </div>
                <!-- Product 2 -->
                <div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-8">
                    <div class="bg-white p-3 rounded-lg shadow-lg">
                        <img src="assets/images/products/6.jpg" alt="Product 2" class="w-full object-cover mb-4 rounded-lg">
                        <a href="#" class="text-lg font-semibold mb-2">White shirt with long sleeves</a>
                        <p class=" my-2">Women</p>
                        <div class="flex items-center mb-4">
                            <span class="text-lg font-bold text-gray-900">$29.99</span>
                        </div>
                        <button class="bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full w-full">Add to Cart</button>
                    </div>
                </div>
                <!-- Product 3 -->
                <div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-8">
                    <div class="bg-white p-3 rounded-lg shadow-lg">
                        <img src="assets/images/products/7.jpg" alt="Product 3" class="w-full object-cover mb-4 rounded-lg">
                        <a href="#" class="text-lg font-semibold mb-2">Yellow men's suit</a>
                        <p class="my-2">Men</p>
                        <div class="flex items-center mb-4">
                            <span class="text-lg font-bold text-gray-900">$15.99</span>
                            <span class="text-sm line-through  ml-2">$19.99</span>
                        </div>
                        <button class="bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full w-full">Add to Cart</button>
                    </div>
                </div>
                <!-- Product 4 -->
                <div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-8">
                    <div class="bg-white p-3 rounded-lg shadow-lg">
                        <img src="assets/images/products/8.jpg" alt="Product 4" class="w-full object-cover mb-4 rounded-lg">
                        <a href="#" class="text-lg font-semibold mb-2">Red dress</a>
                        <p class="my-2">Women</p>
                        <div class="flex items-center mb-4">
                            <span class="text-lg font-bold text-primary">$39.99</span>
                            <span class="text-sm line-through ml-2">$49.99</span>
                        </div>
                        <button class="bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full w-full">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

