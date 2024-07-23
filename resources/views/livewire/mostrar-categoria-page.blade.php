<div class="container mx-auto max-w-screen-xl px-4 testimonials">
    <div class="text-center mb-12 lg:mb-20">
        <h2 class="text-5xl font-bold mb-4">Explora <span class="text-primary">Nuestras Categorias</span></h2>
        <p class="my-7">Sumérgete en nuestra variada colección de categorías y descubre productos seleccionados especialmente para ti. ¡Encuentra lo que necesitas y mucho más!</p>
    </div>

    <div class="tarjetas-contenedor row">
        @forelse ($categorias as $categoria)
            <div class="tarjeta-contenedor-personalizado">
                <a href="{{ route('productoshop', ['categoria' => $categoria->id]) }}" class="tarjeta-link">
                <div class="tarjeta-personalizada">
                        @if (isset($categoria->imagen))
                            <div class="imagen-contenedor-personalizado">
                                <img src="{{ url('storage/' , $categoria->imagen) }}" class="imagen-personalizada" alt="{{ $categoria->nombre }}" loading="lazy">
                            </div>
                        @endif
                        <div class="enlace-personalizado">
                            <i class="fas fa-eye mr-1"></i>
                            <span>{{ $categoria->nombre }}</span>
                        </div>
                        <div class="descripcion">
                            <p>{{ $categoria->descripcion }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="text-center">
                <p>No hay categorías disponibles en este momento. ¡Vuelve pronto para descubrir más!</p>
            </div>
        @endforelse
    </div>

    @if ($categorias->isNotEmpty())
        <div class="d-flex justify-content-center paginacion">
            {{ $categorias->links() }}
        </div>
    @endif
</div>
