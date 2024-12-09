<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $category_id = $request->category_id;
        $products = Product::filterAdvancedProduct($search,$category_id)->paginate(25);


        return response()->json([
            "status" => true,
            "products" => ProductCollection::make($products)
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'seller_id' => 'required|exists:sellers,id',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|url',
        ]);

        Product::create($validated);

        return response()->json([
            "message"=>"product created"
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                "status" => false,
                "message" => "Product not found"
            ], 404);
        }

        return response()->json([
            "status" => true,
            "data" => ProductResource::make($product)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }

        $product->update($request->all());

        return response()->json([
            "message" => "Product updated"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }

        // Delete the image if exists
        if ($product->image_url) {
            Storage::delete($product->image_url);
        }

        $product->delete();

        return response()->json([
            "message" => "Product deleted"
        ], 200);
    }
}
