<div class="mb-8 text-center">
    <h2 class="text-2xl font-semibold mb-4">Categorías</h2>
    <div class="flex flex-wrap -mx-4">
        @foreach ($categorias as $categoria)
            <div class="w-full sm:w-1/2 md:w-1/4 lg:w-1/4 xl:w-1/4 px-4 mb-8">
                <div class="bg-white p-3 rounded-lg shadow-lg text-center">
                    @if (isset($categoria->imagen))
                        <div class="rounded-full h-24 w-24 mx-auto mb-4 overflow-hidden border-4 border-gray-200">
                            <img src="{{ url('storage/' . $categoria->imagen) }}" class="h-full w-full object-cover rounded-full" alt="{{ $categoria->nombre }}">
                        </div>
                    @endif
                    <a href="#" class="text-lg font-semibold mb-2 block">{{ $categoria->nombre }}</a>
                </div>
            </div>
        @endforeach
    </div>
</div>