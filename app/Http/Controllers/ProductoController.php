<?php

namespace App\Http\Controllers;

use App\Models\Producto;

use Illuminate\Http\Request;
use Exception;

class ProductoController extends Controller
{
    //
    public function index()
    {
        $producto = Producto::where('estado', '=', '1')->get();
        return response()->json($producto);
    }

    public function store(Request $request)
    {
        try {
            $producto = new Producto();
            $producto->descripcion = $request->descripcion;
            $producto->foto = $request->foto;
            $producto->precio = $request->precio;
            $producto->cantidad = $request->cantidad;
            $producto->estado = 1;
            $producto->save();
            $result = [
                'descripcion' => $producto->descripcion,
                'foto' => $request->foto,
                'precio' => $producto->precio,
                'cantidad' => $request->cantidad,
                'idProducto' => $producto->idProducto,
                'created' => true
            ];
            return $result;
        } catch (Exception $e) {
            return "Error fatal - " . $e->getMessage();
        }
    }
    public function listado(Request $request)
    {
        $producto = Producto::where('estado', '=', '1')->get();
        return response()->json($producto);
    }
}
