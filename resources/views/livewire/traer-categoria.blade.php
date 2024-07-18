<div>
    
<div class="w-full sm:w-1/6 px-4 mb-8">
<h3 class="text-lg font-semibold mb-4">Categorias</h3>
    @forelse ($categoria as $categorias)
            
            <ul>
                <li><a href="#" class="hover:text-primary">{{$categorias->nombre}}</a></li>
                @empty
        <li>No se encontraron categorías.</li>
            </ul>
            @endforelse
 </div>

</div>
