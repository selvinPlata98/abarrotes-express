<div>

<section id="product-slider">
        <div class="main-slider swiper-container">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <img src="/imagen/logo.jpeg" alt="Product 1">
                    <div class="swiper-slide-content">
                      <h2 class="text-3xl md:text-7xl font-bold text-white mb-2 md:mb-4">Women</h2>
                      <p class="mb-4 text-white md:text-2xl">Experience the best in sportswear with <br>our latest collection.</p>
                        <a href="/"
                            class="bg-primary hover:bg-transparent text-white hover:text-white border border-transparent hover:border-white font-semibold px-4 py-2 rounded-full inline-block">Shop
                            now</a>
                    </div>
                </div>


                <section id="brands" class="bg-white py-16 px-4">
        <div class="container mx-auto max-w-screen-xl px-4 testimonials">
          <div class="text-center mb-12 lg:mb-20">
          <h2 class="text-2xl font-bold mb-8">Nuestro productos</h2>
        </div>


 <!-- Traer los productos de la base de datos -->
<div class="flex flex-wrap -mx-4">
    @foreach ($producto as $productos)
    @if($productos->en_oferta = 0)
    <a href="#" class="text-lg font-semibold mb-2">{{$productos->nombre}}</a>
                <div class="flex items-center mb-4">
                    <span class="text-sm line-through ml-2">{{$productos->precio}}</span>
                </div>
                <button class="bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full w-full">agregar al carrito</button>
            </div>
        </div>
        @else
        <div class="w-full sm:w-1/2 md:w-1/4 lg:w-1/4 xl:w-1/4 px-4 mb-8">
            <div class="bg-white p-3 rounded-lg shadow-lg">
            @if(isset($productos->imagenes) && count($productos->imagenes) > 0)
    <img src="{{ url('storage/' . $productos->imagenes[0]) }}" class="w-full object-cover mb-4 rounded-lg" alt="Producto 1">
  @endif              
  <a href="#" class="text-lg font-semibold mb-2">{{$productos->nombre}}</a>
                <div class="flex items-center mb-4">
                    <span class="text-lg font-bold text-primary">{{$productos->precio - $productos->en_oferta}}</span>
                    <span class="text-sm line-through ml-2">{{$productos->precio}}</span>
                </div>
                <button class="bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full w-full">agregar al carrito</button>
            </div>
        </div>
      @endif 

    @endforeach


    <section id="brands" class="bg-white py-16 px-4">
        <div class="container mx-auto max-w-screen-xl px-4 testimonials">
          <div class="text-center mb-12 lg:mb-20">
            <h2 class="text-5xl font-bold mb-4">Descubra <span class="text-primary">Nuestras Categoria</span></h2>
            <p class="my-7">Descubre las principales categorías que ofrecemos en nuestra tienda y explora todo lo que tenemos para ti.</p>
        </div>
    
    
 <!-- Traer los categoria de la base de datos -->
 <div class="flex flex-wrap -mx-4">
    @forelse ($categoria as $categorias)
        <div class="w-full sm:w-1/2 md:w-1/4 lg:w-1/4 xl:w-1/4 px-4 mb-8">
            <div class="bg-white p-3 rounded-lg shadow-lg">
                
            @if(isset($categorias->imagenes) && count($categorias->imagenes) > 1)
    <img src="{{ url('storage/' . $categorias->imagenes[0]) }}" class="w-full object-cover mb-4 rounded-lg" alt="{{$categorias->imagenes[0]}}">
  @endif    
  <a href="#" class="text-lg font-semibold mb-2">{{$categorias->nombre}}</a>
                <button class="bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full w-full">agregar al carrito</button>
            </div>
            

        </div>
    @empty
        <p>No se encontraron categorías.</p>
    @endforelse
</div>


</div>

<section id="brands" class="bg-white py-16 px-4">
        <div class="container mx-auto max-w-screen-xl px-4 testimonials">
          <div class="text-center mb-12 lg:mb-20">
            <h2 class="text-5xl font-bold mb-4">Descubra <span class="text-primary">Nuestras Marcas</span></h2>
            <p class="my-7">Explora las principales marcas que presentamos en nuestra tienda</p>
        </div>
        <div class="flex flex-wrap -mx-4">
        @forelse ($marca as $marcas)
        <div class="w-full sm:w-1/2 md:w-1/4 lg:w-1/4 xl:w-1/4 px-4 mb-8">
            <div class="bg-white p-3 rounded-lg shadow-lg">

            <img src="{{ isset($marcas->imagenes) && count($marcas->imagenes) > 0 ? url('storage/' . $marcas->imagenes[0]) : '' }}" class="w-full object-cover mb-4 rounded-lg" alt="Producto 1">

                <a href="#" class="text-lg font-semibold mb-2">{{$marcas -> nombre}}</a>
                <button class="bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full w-full">agregar al carrito</button>
            </div>
        </div>
        @empty
        <p>No se encontraron categorías.</p>
    @endforelse

   
    </section>



<section class="py-16">
      <div class="relative items-center w-full px-5 py-12 mx-auto md:px-12 lg:px-24 max-w-7xl">
          <div class="grid w-full grid-cols-1 gap-6 mx-auto lg:grid-cols-3">
              <div class="flex flex-col p-6 bg-white rounded-xl shadow-lg">
              <h1 class="mb-4 text-2xl font-semibold leading-none tracking-tighter text-gray-dark lg:text-3xl">Compra 100% segura.</h1>
                  <p class="flex-grow text-base font-medium leading-relaxed text-gray-txt">Compra con confianza en abarrotes-express, tu tienda en línea donde garantizamos una experiencia satifatoria</p>
                  <img class="object-cover object-center w-full mb-8 rounded-xl" src="/imagen/segurida.png" alt="blog">
                  
              </div>
              <div class="flex flex-col p-6 bg-white rounded-xl shadow-lg">
                  <h1 class="mb-4 text-2xl font-semibold leading-none tracking-tighter text-gray-dark lg:text-3xl">Metodo de pago</h1>
                  <p class="flex-grow text-base font-medium leading-relaxed text-gray-txt">Pago con tarjeta de crédito o débito</p>
                  <img class="object-cover object-center w-full mb-8 rounded-xl" src="imagen/tarjeta.png" alt="blog">
              </div>
              <div class="flex flex-col p-6 bg-white rounded-xl shadow-lg">
                  <h1 class="mb-4 text-2xl font-semibold leading-none tracking-tighter text-gray-dark lg:text-3xl">Recibe tu producto</h1>
                  <p class="flex-grow text-base font-medium leading-relaxed text-gray-txt">Coordina la entrega de tu compra directamente con el vendedor. Tienes la opción de recibirlo cómodamente en tu domicilio, en la oficina o elegir recogerlo personalmente. ¡Tú tienes la libertad de decidir lo que más te convenga!.</p>
                  <img class="object-cover object-center w-full mb-8 rounded-xl" src="imagen/envioo.png" alt="blog">

              </div>
          </div>
      </div>
    </section>



</div>
