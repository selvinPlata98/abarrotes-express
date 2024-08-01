<div class="container mx-auto max-w-screen-xl px-4 categories">
    <div class="text-center title-container mb-12 lg:mb-20">
        <h2 class="text-5xl font-weight-medium mb-4">Explora <span class="text-primary">Nuestras Marcas</span></h2>
        <p class="my-7 text-muted">Explora nuestra selección de marcas destacadas y descubre productos especialmente seleccionados para ti. ¡Encuentra calidad y variedad en cada marca que ofrecemos!</p>
    </div>

    <div class="search-bar-container mx-auto max-w-screen-xl px-4 mb-8">
        <div class="relative flex items-center max-w-md mx-auto">
            <input type="text"  id="searchInput" class="search-input" wire:model.live="search"   placeholder="Buscar marcas...">
            <button id="clearButton" class="clear-button hidden" >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <button id="searchButton" class="search-button" >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M15.25 10.75a5.5 5.5 0 11-11 0 5.5 5.5 0 0111 0z"/>
                </svg>
            </button>
        </div>
    </div>

    <div class="cards-container flex flex-wrap">
        @forelse ($marcas as $marca)
            <div class="brand-card my-2 mx-auto p-relative bg-white shadow-1 blue-hover" style="width: 360px; overflow: hidden; border-radius: 1px;" data-name="{{ strtolower($marca->nombre) }}">
                @if (isset($marca->imagen))
                    <div class="card-bg" style="background-image: url('{{ asset('storage/' , $marca->imagen) }}'); width: 100%; height: 200px; background-size: cover; background-position: center;"></div>
                @else
                    <img src="https://images.pexels.com/photos/442559/pexels-photo-442559.jpeg?auto=compress&cs=tinysrgb" alt="Imagen por defecto" class="d-block w-full" style="width: 100%; height: 200px; object-fit: cover;">
                @endif

                <div class="px-2 py-2">
                    <p class="mb-0 small font-weight-medium text-uppercase mb-1 text-muted lts-2px">
                        {{ $marca->nombre }}
                    </p>

                    <h1 class="font-weight-normal text-black card-heading mt-0 mb-1" style="line-height: 1.25;">
                        {{ $marca->nombre }}
                    </h1>

                    <p class="card-description mb-1">
                        {{ $marca->descripcion }}
                    </p>
                </div>

                <a href="{{ route('productoshop', ['categoria' => $marca->id]) }}" class="text-uppercase d-inline-block font-weight-medium lts-2px ml-2 mb-2 text-center styled-link">
                    Ver más
                </a>
            </div>
        @empty
            <div class="text-center">
                <p class="text-muted">No hay marcas disponibles en este momento. ¡Vuelve pronto para descubrir más!</p>
            </div>
        @endforelse
    </div>

    @if ($marcas->isNotEmpty())
        <div class="text-center mt-4">
            {{ $marcas->links() }}
        </div>
    @endif
</div>



