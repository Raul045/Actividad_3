<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'nombre' => $faker->word, 
        'descripcion' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
