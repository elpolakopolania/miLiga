<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'persona_id' => function(){
          return factory(App\Persona::class)->create()->id;
        },
        'tipo_usuario_id' => $faker->numberBetween($min = 1, $max = 4),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Persona::class, function (Faker\Generator $faker) {
    return [
      'nombres' => $faker->name,
      'apellidos' => $faker->lastName,
      'tipoIdent_id' => $faker->numberBetween($min = 1, $max = 9),
      'numIdent' => $faker->randomNumber($nbDigits = 9, $strict = true),
      'telefono' => $faker->e164PhoneNumber,
      'fechaNac' => $faker->date($format = 'Y-m-d'),
      'genero'  => 'M'
    ];
});
