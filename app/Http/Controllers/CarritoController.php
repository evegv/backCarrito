<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\CompraProducto;
use App\Models\Producto;

class CarritoController extends Controller
{
    //
    public function store(Request $request)
    {
        $items = $request->input('items');
        $total = 0;

        foreach ($items as $item) {
            $total += $item['cantidad'] * $item['precio'];
        }

        // Iniciar la transacción
        DB::beginTransaction();

        try {
            // Crear el carrito
            $carrito = Carrito::create(['total' => $total]);

            // Construir array para la inserción masiva de compra_productos
            $compraProductos = [];
            foreach ($items as $item) {
                $compraProductos[] = [
                    'idCarrito' => $carrito->idCarrito,
                    'idProducto' => $item['idProducto'],
                    'cantidad' => $item['cantidad'],
                    'precio' => $item['precio'],
                ];
            }

            // Insertar registros en compra_producto de manera masiva
            CompraProducto::insert($compraProductos);

            // Confirmar la transacción
            DB::commit();

            return response()->json(['message' => 'Compra realizada con éxito']);
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollback();

            return response()->json(['error' => 'Error al procesar la compra'], 500);
        }
    }
}
