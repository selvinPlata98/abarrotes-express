<div class="container mx-auto max-w-screen-xl px-4 categories">
    <div class="text-center title-container mb-12 lg:mb-20">
        <h2 class="text-5xl font-weight-medium mb-4">Explora <span class="text-primary">Nuestras Categorías</span></h2>
        <p class="my-7 text-muted">Sumérgete en nuestra variada colección de categorías y descubre productos seleccionados especialmente para ti. ¡Encuentra lo que necesitas y mucho más!</p>
    </div>

    <div class="cards-container flex flex-wrap">
        @forelse ($categorias as $categoria)
            <div class="my-2 mx-auto p-relative bg-white shadow-1 blue-hover" style="width: 360px; overflow: hidden; border-radius: 1px;">
                @if (isset($categoria->imagen))
                    <div class="card-bg" style="background-image: url('{{ asset('storage/' , $categoria->imagen) }}'); width: 100%; height: 200px; background-size: cover; background-position: center;"></div>
                @else
                    <img src="https://images.pexels.com/photos/442559/pexels-photo-442559.jpeg?auto=compress&cs=tinysrgb" alt="Imagen por defecto" class="d-block w-full" style="width: 100%; height: 200px; object-fit: cover;">
                @endif

                <div class="px-2 py-2">
                    <p class="mb-0 small font-weight-medium text-uppercase mb-1 text-muted lts-2px">
                        {{ $categoria->nombre }}
                    </p>

                    <h1 class="font-weight-normal text-black card-heading mt-0 mb-1" style="line-height: 1.25;">
                        {{ $categoria->nombre }}
                    </h1>

                    <p class="card-description mb-1">
                        {{ $categoria->descripcion }}
                    </p>
                </div>

                <a href="{{ route('productoshop', ['categoria' => $categoria->id]) }}" class="text-uppercase d-inline-block font-weight-medium lts-2px ml-2 mb-2 text-center styled-link">
                    Ver más
                </a>
            </div>
        @empty
            <div class="text-center">
                <p class="text-muted">No hay categorías disponibles en este momento. ¡Vuelve pronto para descubrir más!</p>
            </div>
        @endforelse
    </div>

    @if ($categorias->isNotEmpty())
        <div class="text-center mt-4">
            {{ $categorias->links() }}
        </div>
    @endif
</div>
