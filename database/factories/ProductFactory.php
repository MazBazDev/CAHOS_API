<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'quantity' => $this->faker->randomNumber(2),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'expiration_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'location' => $this->faker->word(),
            'category_id' => $this->faker->randomElement(Category::all()->pluck('id')->toArray()),
        ];
    }
}
