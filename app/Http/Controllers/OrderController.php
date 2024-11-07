<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        return Order::all()->load("product", "client");
    }

    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();
        $product = Product::find($data["product_id"]);

        $data["total"] = $data["quantity"] * $product->price;
        $data["order_date"] = now();

        $order = Order::create($data);

        $product->stock -= $data["quantity"];
        $product->save();

        return response()->json($order->load("product", "client"), 201);
    }

    public function show(Order $order)
    {
        return response()->json($order->load("product", "client"));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $data = $request->validated();

        $product = isset($data["product_id"]) ? Product::find($data["product_id"]) : $order->product;

        if (isset($data["quantity"])) {
            $data["total"] = $data["quantity"] * ($product ? $product->price : $order->product->price);

            if ($product) {
                $product->stock += $order->quantity;
                $product->stock -= $data["quantity"];
                $product->save();
            }
        }

        if (isset($data["order_date"])) {
            $data["order_date"] = now();
        }

        $order->update($data);

        return response()->json($order->load("product", "client"));
    }

    public function destroy(Order $order)
    {
        return response()->json($order->delete());
    }
}
