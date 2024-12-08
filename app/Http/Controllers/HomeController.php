<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;

class HomeController extends Controller
{
    public function alerts()
    {
        $stocks = Product::where('quantity', '<=', 5)->get();
        $expire_soon = Product::where('expiration_date', '<=', now()->addDays(5))->get();

        return response()->json([
            'stocks' => $stocks->map(function ($product) {
                return "{$product->name} has only {$product->quantity} left";
            }),
            'expire_soon' => $expire_soon->map(function ($product) {
                if ($product->expiration_date->isPast()) {
                    return "The product : {$product->name} has expired";
                }

                return "The product : {$product->name} will expire on {$product->expiration_date}";
            })
        ]);
    }

    public function dashboard()
    {
        $topRequest = Order::selectRaw('product_id, SUM(quantity) as total_sales')
            ->groupBy('product_id')
            ->orderByDesc('total_sales')
            ->limit(3)
            ->get();

        return response()->json([
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_clients' => Client::count(),
            'top_sales' => $topRequest->map(function ($order) {
                return [
                    'product_name' => $order->product->name ?? 'Product deleted',
                    'total_sales' => $order->total_sales
                ];
            })
        ]);
    }

    public function stats()
    {
        $ordersByDay = Order::selectRaw('DATE(order_date) as date, COUNT(*) as order_count')
            ->whereMonth('order_date', now()->month)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'series' => $ordersByDay->pluck('order_count'),
            'labels' => $ordersByDay->pluck('date')
        ]);
    }
}
