<?php

namespace Database\Factories;

use App\Models\Obra;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObraFactory extends Factory
{
    protected $model = Obra::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->sentence(),
            'capitulos' => $this->faker->numberBetween(1,300),
            'likes' => $this->faker->randomNumber(3),
            'descripcion' => $this->faker->paragraph(),
            'imagen' => $this->faker->randomElement(['uploads/illustration-1.jpg', 'uploads/illustration-2.jpg', 'uploads/illustration-3.jpg']),
        ];
    }
}
