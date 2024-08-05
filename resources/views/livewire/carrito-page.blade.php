<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-4">Carrito</h1>
        <div class="flex flex-col md:flex-row gap-4">
            <div class="md:w-3/4">
                <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
                    <table class="w-full">
                        <thead>
                        <tr>
                            <th class="text-left font-semibold">Producto</th>
                            <th class="text-left font-semibold">Precio</th>
                            <th class="text-left font-semibold">Cantidad</th>
                            <th class="text-left font-semibold">Total</th>
                            <th class="text-left font-semibold">Quitar</th>
                        </tr>
                        </thead>
                        {{--Editar los datos--}}
                        <tbody>
                        @forelse($elementos_carrito as $item)
                            <tr wire:key="{{$item['producto_id']}}">
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img class="h-16 w-16 mr-4" src="{{ url('storage', $item['imagen']) }}" alt="{{$item['nombre']}}">
                                        <span class="font-semibold"></span>
                                    </div>
                                </td>
                                <td class="py-4">{{Number::currency($item['monto_unitario'],'LPS')}}</td>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <button wire:click="decreaseQty({{$item['producto_id']}})" class="border rounded-md py-2 px-4 mr-2">-</button>
                                        <span class="text-center w-8">{{$item['cantidad']}}</span>
                                        <button wire:click="increaseQty({{$item['producto_id']}})" class="border rounded-md py-2 px-4 ml-2">+</button>
                                    </div>
                                </td>
                                <td class="py-4">{{Number::currency($item['monto_total'], 'lps')}}</td>
                                <td>
                                    <button wire:click="removeItem({{$item['producto_id']}})" class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700">
                                        <span wire:loading.remove wire:target='removeItem({{$item['producto_id']}})'>Eliminar</span>
                                        <span wire:target="removeItem({{$item['producto_id']}})" wire:loading>Eliminando...</span>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-4xl font-semibold text-sky-500"> No hay items en el carrito</td>
                            </tr>
                        @endforelse
                        <!-- More product rows -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="md:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold mb-4">Detalles de compra</h2>
                    <div class="flex justify-between mb-2">
                        <span>Subtotal</span>
                        <span>{{Number::currency($total_final, 'lps')}}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Impuestos</span>
                        <span>{{Number::currency(0, 'lps')}}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Envios</span>
                        <span>{{Number::currency(0, 'lps')}}</span>
                    </div>
                    <hr class="my-2">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Total</span>
                        <span class="font-semibold">{{Number::currency($total_final, 'lps')}}</span>
                    </div>
                    @if($elementos_carrito)
                        <a href="/pedido" class="bg-blue-500 text-white py-2 px-4 block rounded-lg mt-4 w-full">Checkout</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

