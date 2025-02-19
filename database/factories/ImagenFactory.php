<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;

class ImagenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $seed = Str::random(10);
        return [
            'descripcion' => fake()->text(),
            'url' => "https://picsum.photos/seed/$seed/300/200",
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
