<?php

namespace Database\Factories;

use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ArticuloUser;
use App\Models\User;

class PedidoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pedido::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $idUser=User::all()->random()->id;
        return [
            'user_id'=>$idUser
        ];
    }
}
