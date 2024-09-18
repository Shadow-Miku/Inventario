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

        return redirect()->route('home')->with('success', 'Product registered successfully.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
