<?php

namespace Database\Factories;

use App\Models\ArticuloUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Articulo;
use App\Models\User;

class ArticuloUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ArticuloUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $idArt=Articulo::all()->random()->id;
        $codArt=(Articulo::find($idArt))->codigo;
        $desArt=(Articulo::find($idArt))->descripcion;
        $idUser=User::all()->random()->id;
        return [
            'user_id'=>$idUser,
            'articulo_id'=>$idArt,
            'codigo'=>$codArt,
            'descripcion'=>$desArt,
            'cantidad'=>$this->faker->numberBetween(1,20),
        ];
    }
}
