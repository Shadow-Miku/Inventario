<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();

        return view('welcome', compact('products'));
    }

    public function list()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('url')) {
            $imagePath = $request->file('url')->store('products', 'public');
        }

        Product::create([
            'product_name' => $request->product_name,
            'serial' => $request->serial,
            'category' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock,
            'url' => $imagePath ?? null
        ]);

        return redirect()->back()->with('success', 'Product registered successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'serial' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'url' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);


        // Actualizar los campos
        $product->update($validated);

        // Manejar la subida de la imagen si se proporciona una nueva

        if ($request->hasFile('url')) {
            // Eliminar la imagen anterior si es necesario
            if ($product->url) {
                \Storage::delete('public/' . $product->url);
            }

            $path = $request->file('url')->store('images', 'public');
            $product->url = $path;
            $product->save();
        }

        return redirect()->back()->with('updated', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Verifica si la imagen existe y elimínala
        if ($product->url && \Storage::exists('public/' . $product->url)) {
            \Storage::delete('public/' . $product->url);
        }

        // Elimina el producto de la base de datos
        $product->delete();

        return redirect()->back()->with('deleted', 'Product deleted successfully.');
    }




}

