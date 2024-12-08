<?php

namespace Database\Factories;

use App\Models\Direccion;
use App\Models\Orden;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DireccionFactory extends Factory
{
    protected $model = Direccion::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'nombres' => $this->faker->word(),
            'apellidos' => $this->faker->word(),
            'telefono' => $this->faker->word(),
            'departamento' => $this->faker->word(),
            'municipio' => $this->faker->word(),
            'ciudad' => $this->faker->word(),
            'direccion_completa' => $this->faker->word(),

            'orden_id' => Orden::factory(),
        ];
    }
}
