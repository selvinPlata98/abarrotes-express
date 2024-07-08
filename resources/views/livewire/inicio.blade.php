<div>


<div class="flex flex-wrap -mx-4">
    @foreach ($producto as $productos)
        <div class="w-full sm:w-1/2 md:w-1/4 lg:w-1/4 xl:w-1/4 px-4 mb-8">
            <div class="bg-white p-3 rounded-lg shadow-lg">
                <img src="/storage/productos/" alt="Producto 1" class="w-full object-cover mb-4 rounded-lg">
                <a href="#" class="text-lg font-semibold mb-2">{{$productos->nombre}}</a>
                <p class="my-2">{{$productos->descripcion}}</p>
                <div class="flex items-center mb-4">
                    <span class="text-lg font-bold text-primary">{{$productos->precio - $productos->en_oferta}}</span>
                    <span class="text-sm line-through ml-2">{{$productos->precio}}</span>
                </div>
                <button class="bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full w-full">agregar al carrito</button>
            </div>
        </div>
      

    @endforeach
</div>





</div>
