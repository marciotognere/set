<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Aluno;
use Faker\Generator as Faker;

$factory->define(Aluno::class, function (Faker $faker) {
    return [
      'cpfAluno'   => 'EMP' . $faker->randomNumber(5, true),
      'senhaAluno' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
    ];
});
