<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $products = Product::all()->random(1)->first();
        $quantity = $this->faker->randomNumber(2);
        $client_id = Client::all()->random(1)->first()->id;

        return [
            'client_id' => $client_id,
            'product_id' => $products->id,
            'quantity' => $quantity,
            'total' => $products->price * $quantity,
            'order_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
        ];
    }
}
