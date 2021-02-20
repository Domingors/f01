<?php

namespace Database\Factories;

use App\Models\ArticuloUser;
use App\Models\LPedido;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Pedido;

class LPedidoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LPedido::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $idArt=ArticuloUser::all()->random()->id;
        $codArt=(ArticuloUser::find($idArt))->codigo;
        $desArt=(ArticuloUser::find($idArt))->descripcion;
        $idPedido=Pedido::all()->random()->id;
        return [
            'Pedido_id'=>$idPedido,
            'articuloUser_id'=>$idArt,
            'codigo'=>$codArt,
            'descripcion'=>$desArt,
            'cantidad'=>$this->faker->numberBetween(1,20),
        ];
    }
}
