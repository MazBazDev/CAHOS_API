<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        activity("Create", "Product :name created.", [
            ":name" => $product->name
        ]);

        return response()->json($product, 201);
    }

    public function show(Product $product)
    {

        activity("Read", "Product :name read.", [
            ":name" => $product->name
        ]);

        return response()->json($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        activity("Update", "Product :name updated.", [
            ":name" => $product->name
        ]);

        return response()->json($product->refresh());
    }

    public function destroy(Product $product)
    {
        activity("Delete", "Product :name deleted.", [
            ":name" => $product->name
        ]);

        return response()->json($product->delete());
    }
}
