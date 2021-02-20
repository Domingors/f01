<?php

namespace Database\Factories;

use App\Models\Articulo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticuloFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Articulo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $codigo=$this->faker->unique()->text(10);
        return [
            'codigo'=>$codigo,
            'descripcion'=>$this->faker->text(50),
            'cantidad'=>$this->faker->numberBetween(1,20),
        ];
    }
}
