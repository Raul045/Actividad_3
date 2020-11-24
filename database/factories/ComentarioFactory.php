<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'titulo'=>$faker->word,
        'contenido' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'producto_id' => 'App\Modelos\Producto'->all()->random()->id,
        'usuario_id' => 'App\User'->all()->random()->id,
    ];
});
