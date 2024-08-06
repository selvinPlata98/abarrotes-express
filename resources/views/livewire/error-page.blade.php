<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" type="icon" href="assets/images/favicon.png" />
    <title>{{$title ?? 'Abarrotes Express'}}</title>
    @livewireStyles
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{url(asset('/js/script.js'))}}"></script>
    <link rel="stylesheet" href="{{url(asset('/css/estilo/styles.css'))}}">
    <link rel="stylesheet" href="{{url(asset('/css/estilo/custom.css'))}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
<main>
    <section id="pagina-404" class="fondo-blanco py-16 flex items-center justify-center min-h-screen">
        <div class="mx-auto max-w-screen-lg px-4 md:px-8">
            <div class="grid gap-8 sm:grid-cols-2">
                <div class="flex flex-col items-center justify-center sm:items-start md:py-24 lg:py-32">
                    <h1 class="texto-4xl fuente-negrita color-principal mb-5">404 - Página No Encontrada</h1>
                    <p class="texto-gris mb-5">La página que estás buscando puede haber sido eliminada, renombrada o está temporalmente no disponible.</p>
                    <div class="botones-contenedor">
                        <a href="{{ url('/inicio') }}" class="boton-regresar">Regresar</a>
                        <a href="{{ url('/inicio') }}" class="boton-regresar">Ir a la página de inicio</a>
                    </div>
                </div>
                <div class="relativo h-80 overflow-hidden redondear-lg fondo-gris-sombreado md:h-auto">
                    <img src="/imagen/Carrito404.jpg" alt="Imagen de Error 404" class="w-full h-auto">
                </div>
            </div>
        </div>
    </section>
</main>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" type="icon" href="assets/images/favicon.png" />
    <title>{{$title ?? 'Abarrotes Express'}}</title>
    @livewireStyles
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{url(asset('/js/script.js'))}}"></script>
    <link rel="stylesheet" href="{{url(asset('/css/estilo/styles.css'))}}">
    <link rel="stylesheet" href="{{url(asset('/css/estilo/custom.css'))}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
@livewire('complementos.navbar')
<main>
    <section id="pagina-403" class="fondo-blanco py-16 flex items-center justify-center min-h-screen">
        <div class="mx-auto max-w-screen-lg px-4 md:px-8">
            <div class="grid gap-8 sm:grid-cols-2">
                <div class="flex flex-col items-center justify-center sm:items-start md:py-24 lg:py-32">
                    <h1 class="texto-4xl fuente-negrita color-principal mb-5">403 - No tienes Permiso para acceder a esta página</h1>
                    <p class="texto-gris mb-5"> Acceso  denegado a  esta página.</p>
                    <div class="botones-contenedor">
                        <a href="{{ url('/inicio') }}" class="boton-regresar">Regresar</a>
                        <a href="{{ url('/inicio') }}" class="boton-regresar">Ir a la página de inicio</a>
                    </div>
                </div>
                <div class="relativo h-80 overflow-hidden redondear-lg fondo-gris-sombreado md:h-auto">
                    <img src="/imagen/Carrito404.jpg" alt="Imagen de Error 403" class="w-full h-auto">
                </div>
            </div>
        </div>
    </section>
</main>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" type="icon" href="assets/images/favicon.png" />
    <title>{{$title ?? 'Abarrotes Express'}}</title>
    @livewireStyles
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{url(asset('/js/script.js'))}}"></script>
    <link rel="stylesheet" href="{{url(asset('/css/estilo/styles.css'))}}">
    <link rel="stylesheet" href="{{url(asset('/css/estilo/custom.css'))}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
@livewire('complementos.navbar')

<main>
    <section id="pagina-500" class="fondo-blanco py-16 flex items-center justify-center min-h-screen">
        <div class="mx-auto max-w-screen-lg px-4 md:px-8">
            <div class="grid gap-8 sm:grid-cols-2">
                <div class="flex flex-col items-center justify-center sm:items-start md:py-24 lg:py-32">
                    <h1 class="texto-4xl fuente-negrita color-principal mb-5">500 - Lo sentimos, ha ocurrido un error interno en el servidor</h1>
                    <p class="texto-gris mb-5">Estamos trabajando para solucionar el problema. Por favor, intenta nuevamente más tarde</p>
                    <p>Si el problema persiste, contacta al administrador del sistema.</p>
                    <div class="botones-contenedor">
                        <a href="{{ url('/inicio') }}" class="boton-regresar">Regresar</a>
                        <a href="{{ url('/inicio') }}" class="boton-regresar">Ir a la página de inicio</a>
                    </div>
                </div>
                <div class="relativo h-80 overflow-hidden redondear-lg fondo-gris-sombreado md:h-auto">
                    <img src="/imagen/Carrito404.jpg" alt="Imagen de Error 500" class="w-full h-auto">
                </div>
            </div>
        </div>
    </section>
</main>

@livewire('complementos.footer')
@livewireScripts
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>


