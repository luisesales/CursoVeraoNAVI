<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Veiculo;
use Faker\Generator as Faker;

$factory->define(Veiculo::class, function (Faker $faker) {
    return [
        'modelo' => $faker->name,
        'fabricante' => $faker->name,
        'ano_fabricacao' => $faker->year($max = 'now'),
        'placa' => $faker->numberBetween($min = 1000, $max = 9999),
        'uf' =>  $faker->text($maxNbChars = 2),      
    ];
});