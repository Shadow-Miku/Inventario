<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Venta;
use App\Models\VentaProducto;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Mostrar el carrito
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        return view('cart', compact('cart', 'total'));
    }

    // Agregar un producto al carrito
    public function add(Request $request)
    {
        $productId = $request->input('producto_id');
        $cantidad = $request->input('cantidad', 1);

        $product = Product::findOrFail($productId);

        $cart = session()->get('cart', []);

        if(isset($cart[$productId])) {
            $cart[$productId]['cantidad'] += $cantidad;
        } else {
            $cart[$productId] = [
                "producto_id" => $product->id,
                "product_name" => $product->product_name,
                "precio" => $product->price,
                "cantidad" => $cantidad,
                "serial" => $product->serial,
                "category" => $product->category,
                "url" => $product->url
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Producto agregado al carrito exitosamente!');
    }

    // Actualizar la cantidad de un producto en el carrito
    public function update(Request $request)
    {
        if($request->id && $request->cantidad){
            $cart = session()->get('cart');
            $cart[$request->id]["cantidad"] = $request->cantidad;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Carrito actualizado exitosamente!');
        }
    }

    // Remover un producto del carrito
    public function remove(Request $request)
    {
        if($request->id){
            $cart = session()->get('cart');
            if(isset($cart[$request->id])){
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Producto eliminado exitosamente!');
        }
    }

    // Limpiar el carrito
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Carrito limpiado exitosamente!');
    }

    // Checkout y guardar en la base de datos
    public function checkout(Request $request)
    {
        $cart = session()->get('cart');

        if(!$cart || count($cart) == 0){
            return redirect()->back()->with('error', 'El carrito está vacío!');
        }

        DB::beginTransaction();

        try {
            // Calcular total
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['precio'] * $item['cantidad'];
            }

            // Crear venta
            $venta = Venta::create([
                'fecha' => now(),
                'total' => $total,
            ]);

            // Crear venta_productos
            foreach ($cart as $item) {
                VentaProducto::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $item['producto_id'],
                    'cantidad' => $item['cantidad'],
                    'precio' => $item['precio'],
                ]);

                // Actualizar stock
                $product = Product::find($item['producto_id']);
                $product->stock -= $item['cantidad'];
                $product->save();
            }

            DB::commit();

            // Limpiar carrito
            session()->forget('cart');

            return redirect()->route('cart')->with('success', 'Compra realizada exitosamente!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Error al procesar la compra: ' . $e->getMessage());
        }
    }
}
