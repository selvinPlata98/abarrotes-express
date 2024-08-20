<div class="container-cupones">
    <h1 class="cupon-titulo">TUS CUPONES</h1>

    <div class="cupones-grid">
        @foreach($cupones as $cupon)
            <div class="cupon-card">
                <div class="cupon-header">
                    <h2 class="cupon-descuento">Descuento: {{ $cupon->descuento }}%</h2>
                    <p class="cupon-expiracion">Expira: {{ $cupon->fecha_expiracion->format('d-m-Y') }}</p>
                </div>
                <div class="cupon-body">
                    <p class="cupon-codigo">Código: <span>{{ $cupon->codigo }}</span></p>
                    <button class="cupon-usar-btn">Usar</button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="cupon-paginacion">
        {{ $cupones->links() }}
    </div>
</div>
