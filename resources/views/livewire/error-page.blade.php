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
