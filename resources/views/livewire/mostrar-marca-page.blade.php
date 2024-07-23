<div class="container mx-auto max-w-screen-xl px-4 testimonials">
    <div class="text-center mb-12 lg:mb-20">
        <h2 class="text-5xl font-bold mb-4">Explora <span class="text-primary">Nuestras Marcas</span></h2>
        <p class="my-7">Sumérgete en nuestra variada colección de marcas y descubre productos seleccionados especialmente para ti. ¡Encuentra lo que necesitas y mucho más!</p>
    </div>

    <div class="search-bar-container">
        <div class="search-bar-wrapper">
            <input type="text" id="search-input" placeholder="Buscar marcas..." class="search-bar">
            <button class="search-button" aria-label="Buscar">
                <i class="fas fa-search"></i>
            </button>
            <button class="clear-button" aria-label="Limpiar búsqueda" style="display: none;">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>


    <div class="tarjetas-contenedor row">
        @forelse ($marcas as $marca)
            <div class="tarjeta-contenedor-personalizado">
                <div class="tarjeta-personalizada">
                    @if (isset($marca->imagen))
                        <div class="imagen-contenedor-personalizado">
                            <img src="{{ url('storage/' , $marca->imagen) }}" class="imagen-personalizada" alt="{{ $marca->nombre }}" loading="lazy">
                        </div>
                    @endif
                    <div class="enlace-personalizado">
                        <a href="#">
                            <i class="fas fa-eye mr-1"></i>
                        </a>
                        <span>{{ $marca->nombre }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center">
                <p>No hay marcas disponibles en este momento. ¡Vuelve pronto para descubrir más!</p>
            </div>
        @endforelse
    </div>

    @if ($marcas->isNotEmpty())
        <div class="d-flex justify-content-center paginacion">
            {{ $marcas->links() }}
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        const clearButton = document.querySelector('.clear-button');

        searchInput.addEventListener('input', function () {
            if (searchInput.value.length > 0) {
                clearButton.style.display = 'block';
            } else {
                clearButton.style.display = 'none';
            }
        });

        clearButton.addEventListener('click', function () {
            searchInput.value = '';
            clearButton.style.display = 'none';
            searchInput.focus();
        });
    });
</script>
