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

        $product->quantity -= $data["quantity"];
        $product->save();

        activity("Create", "Order :id created.", [
            ":id" => $order->id
        ]);

        return response()->json($order->load("product", "client"));
    }

    public function show(Order $order)
    {

        activity("Read", "Order :id read.", [
            ":id" => $order->id
        ]);

        return response()->json($order->load("product", "client"));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $data = $request->validated();

        $product = isset($data["product_id"]) ? Product::find($data["product_id"]) : $order->product;

        if (isset($data["quantity"])) {
            $data["total"] = $data["quantity"] * ($product ? $product->price : $order->product->price);

            if ($product) {
                $product->quantity += $order->quantity;
                $product->quantity -= $data["quantity"];
                $product->save();
            }
        }

        if (isset($data["order_date"])) {
            $data["order_date"] = now();
        }

        $order->update($data);

        activity("Update", "Order :id updated.", [
            ":id" => $order->id
        ]);

        return response()->json($order->load("product", "client"));
    }

    public function destroy(Order $order)
    {
        $order->product()->quantity += $order->quantity;
        $order->product()->save();

        activity("Delete", "Order :id deleted.", [
            ":id" => $order->id
        ]);

        return response()->json($order->delete());
    }
}
