<div>
        <!-- Shop -->
        <section id="shop">
        <div class="container mx-auto">
            <!-- Top Filter -->
            <div class="flex flex-col md:flex-row justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                   
                </div>
                <div class="flex mt-5 md:mt-0 space-x-4">
    <div class="relative">
        <select class="block appearance-none w-full bg-white border hover:border-primary px-4 py-2 pr-8 rounded-full shadow leading-tight focus:outline-none focus:shadow-outline" wire:model="orden" wire:click="precio">
        <option value="">filtro</option> 
        <option value="tiempo">Producto reciente</option>
        <option value="caro">Orden precio más alto</option>
            <option value="barato">Orden precio más barato</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center justify-center px-2">
            <img id="arrow-down" class="h-4 w-4" src="/imagen/filter.svg" alt="filter arrow">
            <img id="arrow-up" class="h-4 w-4 hidden" src="/imagen/filter-up-arrow.svg" alt="filter arrow">
        </div>
    </div>
</div>



            
                


                
            </div>
            <!-- Filter Toggle Button for Mobile -->
            <div class="block md:hidden text-center mb-4">
                <button id="products-toggle-filters"
                    class="bg-primary text-white py-2 px-4 rounded-full focus:outline-none">Filtrar Productos</button>
            </div>
            <div class="flex flex-col md:flex-row">
                <!-- Filtro -->
                <div id="filters" class="w-full md:w-1/4 p-4 hidden md:block">
                    <!-- Catgoria -->
                    <div class="mb-6 pb-8 border-b border-gray-line">
                        <h3 class="text-lg font-semibold mb-6">Categorias</h3>
                        <div class="space-y-2">
                            @forelse($categoria ?? [] as $categorias)
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox custom-checkbox" 
                       value="{{ $categorias->id }} "  wire:model="categoriasFiltradas" wire:click="filtrocate">
                                <span class="ml-2">{{$categorias->nombre}}</span>
                            </label>
                            @empty
        <li>No se encontraron categorías.</li>
            </ul>
                            @endforelse
                        </div>
                    </div>
                    <!-- Marcas -->
                    <div class="mb-6 pb-8 border-b border-gray-line">
                        <h3 class="text-lg font-semibold mb-6">Marcas</h3>
                        <div class="space-y-2">
                            @forelse($marca ?? [] as $marcas)
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox custom-checkbox"
                                value="{{ $marcas->id }} "  wire:model="marcasFiltradas" wire:click="filtromarcas">
                                <span class="ml-2">{{$marcas->nombre}}</span>
                            </label>
                            @empty
        <li>No se encontraron marcas.</li>
            </ul>
                            @endforelse
                        </div>
                    </div>
                    
                    
                </div>
                <!-- Products List -->
                <div class="flex flex-wrap -mx-3 w-7/10 dim">
    @forelse ($producto as $productos)
        @if($productos->en_oferta > 0)
            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 xl:w-1/3 px-4 mb-8">
                <div class="bg-white p-3 rounded-lg shadow-lg text-center">
                    @if(isset($productos->imagenes) && count($productos->imagenes) > 0)
                        <img src="{{ url('storage~HEAD/' . $productos->imagenes[0]) }}" class="w-full object-cover mb-4 rounded-lg tamanoCard" alt="{{$productos->imagenes[0]}}">
                    @endif              
                    <a href="#" class="text-lg font-semibold mb-2">{{$productos->nombre}}</a>
                    <div class="flex items-center mb-4">
                        <span class="text-lg font-bold text-primary">{{$productos->precio - $productos->en_oferta}}</span>
                        <span class="text-sm line-through ml-2">{{$productos->precio}}</span>
                    </div>
                    <button class="bg-primary text-white border border-primary hover:bg-transparent hover:text-primary py-2 px-3 rounded-full w-full">añadir al carrito</button>
                </div>
            </div>
        @else
            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 xl:w-1/3 px-4 mb-8">
                <div class="bg-white p-3 rounded-lg shadow-lg text-center">
                    @if(isset($productos->imagenes) && count($productos->imagenes) > 0)
                        <img src="{{ url('storage~HEAD/' . $productos->imagenes[0]) }}" class="w-full object-cover mb-4 rounded-lg tamanoCard" alt="{{$productos->imagenes[0]}}">
                    @endif              
                    <a href="#" class="text-lg font-semibold mb-2">{{$productos->nombre}}</a>
                    <div class="flex items-center mb-4">
                        <span class="text-lg font-bold text-primary">{{$productos->precio }}</span>
                    </div>
                    <button class="bg-primary text-white border border-primary hover:bg-transparent hover:text-primary py-2 px-3 rounded-full w-full">añadir al carrito</button>
                </div>
            </div>
        @endif 
    @endforeach
</div>
            </div>
        
    </section>

    <!-- Shop category description -->
    <section id="shop-category-description" class="py-8">
        <div class="container mx-auto">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4">Nuestra Productos</h2>
                <p class="mb-4">
                Descubre nuestra amplia variedad de productos en Abarrote Express,
                 tu tienda de alimentos de confianza. Tenemos todo lo que necesitas para cualquier ocasión, ya sea que estés buscando algo para una comida casual o algo más formal. Nuestra colección incluye una amplia gama de productos de alta calidad, desde enlatados y productos de despensa hasta lácteos, frutas y verduras frescas. También ofrecemos una selección de bebidas no alcohólicas, alimentos preparados, carnes y embutidos, 
                productos de higiene personal, artículos para uso doméstico y productos de limpieza.
                </p>
                <p>
                En Abarrote Express nos enorgullece ofrecer una amplia variedad de marcas y productos para satisfacer todos los gustos y necesidades. Nuestro objetivo es brindarte una experiencia de compra conveniente y satisfactoria,
                 con precios competitivos y un servicio amigable. 
                </p>
            </div>
        </div>
    </section>
</div>
