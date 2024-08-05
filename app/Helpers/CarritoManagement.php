<?php

namespace App\Helpers;

use App\Models\Producto;
use Illuminate\Support\Facades\Cookie;

class CarritoManagement
{
    /*Agregar elementos al carrito*/
    static public function agregarElmentoAlCarrito($producto_id)
    {
        $elementos_carrito = self::obtenerElementosDeCookies();
        $elemento_existente = null;

        foreach ($elementos_carrito as $key => $item) {
            if ($item['producto_id'] == $producto_id) {
                $elemento_existente = $key;
                break;
            }
        }
        if ($elemento_existente !== null) {
            // Incrementar la cantidad del producto existente
            $decimal = ($elementos_carrito[$elemento_existente]['porcentaje_oferta'] / 100);
            $resta = ($elementos_carrito[$elemento_existente]['cantidad'] * $decimal);
            $elementos_carrito[$elemento_existente]['cantidad']++;
            $elementos_carrito[$elemento_existente]['monto_total'] = $elementos_carrito[$elemento_existente]['cantidad'] - $resta;
        } else {
            // Agregar nuevo producto al carrito
            $producto = Producto::where('id', $producto_id)->first(['id', 'nombre', 'precio', 'imagenes', 'porcentaje_oferta']);
            if ($producto) {
                $elementos_carrito[] = [
                    'producto_id' => $producto_id,
                    'nombre' => $producto->nombre,
                    'imagen' => $producto->imagenes[0],
                    'cantidad' => 1,
                    'monto_unitario' => $producto->precio,
                    'monto_total' => $producto->precio
                ];
            }
        }
        self::agregarElementoCookies($elementos_carrito);
        return count($elementos_carrito);
    }

    /*Quitar elemenos del carrito*/
    static public function quitarElementosCarrito($producto_id)
    {
        $elementos_carrito = self::obtenerElementosDeCookies();

        foreach ($elementos_carrito as $key => $item) {
            if ($item['producto_id'] == $producto_id) {
                unset($elementos_carrito[$key]);
            }
        }
        self::agregarElementoCookies($elementos_carrito);
        return $elementos_carrito;
    }

    /*Agregar elementos a cookies*/
    static public function agregarElementoCookies($elementos_carrito)
    {
        Cookie::queue('elementos_carrito', json_encode($elementos_carrito), 60 * 24 * 30);
    }

    static public function quitarElementosCookies()
    {
        Cookie::queue(Cookie::forget('elementos_carrito'));
    }

    /*Obtener elementos de cookies*/
    static public function obtenerElementosDeCookies()
    {
        $elementos_carrito = json_decode(Cookie::get('elementos_carrito'), true);
        if (!$elementos_carrito) {
            $elementos_carrito = [];
        }
        return $elementos_carrito;
    }

    /*Incrementar cantidad de un item en el carrito*/
    static public function incrementarCantidadElementosCarrito($producto_id)
    {
        $elementos_carrito = self::obtenerElementosDeCookies();
        foreach ($elementos_carrito as $key => $item) {
            if ($item['producto_id'] == $producto_id) {
                $elementos_carrito[$key]['cantidad']++;
                $elementos_carrito[$key]['monto_total'] = $elementos_carrito[$key]['cantidad'] *
                    $elementos_carrito[$key]['monto_unitario'];
            }
        }
        self::agregarElementoCookies($elementos_carrito);
        return $elementos_carrito;
    }

    static public function decrementarCantidadElementosCarrito($producto_id)
    {
        $elementos_carrito = self::obtenerElementosDeCookies();
        foreach ($elementos_carrito as $key => $item) {
            if ($item['producto_id'] == $producto_id) {
                if ($elementos_carrito[$key]['cantidad'] > 1) {
                    $elementos_carrito[$key]['cantidad']--;
                    $elementos_carrito[$key]['monto_total'] = $elementos_carrito[$key]['cantidad'] *
                        $elementos_carrito[$key]['monto_unitario'];
                }
            }
        }
        self::agregarElementoCookies($elementos_carrito);
        return $elementos_carrito;
    }

    static public function calcularTotalFinal($elementos)
    {
        return array_sum(array_column($elementos, 'monto_total'));
    }

    static public function agregarElementosAlCarritoConCantidad($producto_id, $cantidad = 1)
    {
        $elementos_carrito = self::obtenerElementosDeCookies();
        $elementos_existentes = null;

        foreach ($elementos_carrito as $key => $item) {
            if ($item['producto_id'] == $producto_id) {
                $elementos_existentes = $key;
                break;
            }
        }
        if ($elementos_existentes != null) {
            $elementos_carrito[$elementos_existentes]['cantidad'] = $cantidad;
            $elementos_carrito[$elementos_existentes]['monto_total'] = $cantidad * $elementos_carrito[$elementos_existentes]['monto_unitario'];

        } else {
            $producto = Producto::where('id', $producto_id)->first(['id', 'nombre', 'precio', 'imagenes', 'porcentaje_oferta']);
            if ($producto) {
                $elementos_carrito[] = [
                    'producto_id' => $producto_id,
                    'nombre' => $producto->nombre,
                    'imagen' => $producto->imagen[0],
                    'cantidad' => $cantidad,
                    'porcentaje_oferta' => $producto->porcentaje_oferta,
                    'monto_unitario' => $producto->precio,
                    'monto_total' => $cantidad * $producto->precio
                ];
            }
        }
        self::agregarElementoCookies($elementos_carrito);
        return count($elementos_carrito);
    }

}
