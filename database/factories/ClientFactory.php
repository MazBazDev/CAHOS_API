<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            "name" => $this->faker->name(),
            "address" => $this->faker->address(),
            "siret" => $this->faker->randomNumber(9),
        ];
    }
}
