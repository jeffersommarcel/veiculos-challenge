<?php

namespace Database\Factories;

use App\Models\Veiculo;
use Illuminate\Database\Eloquent\Factories\Factory;

class VeiculoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Veiculo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'veiculo' => $this->faker->name(),
            'marca' => $this->faker->name(),
            'ano' => '2000',
            'descricao' => $this->faker->text(),
            'vendido' => false
        ];
    }
}
