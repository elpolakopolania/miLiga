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
USE Illuminate\Support\Facades\Auth;

/** Usuarios */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'persona_id' => function(){
          return factory(App\Persona::class)->create()->id;
        },
        'tipo_usuario_id' => $faker->numberBetween($min = 1, $max = 4),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt(123456),
        'remember_token' => str_random(10),
    ];
});

/** Personas */
$factory->define(App\Persona::class, function (Faker\Generator $faker) {
    return [
      'nombres' => $faker->name,
      'apellidos' => $faker->lastName,
      'tipoIdent_id' => $faker->numberBetween($min = 1, $max = 9),
      'numIdent' => $faker->randomNumber($nbDigits = 9, $strict = true),
      'telefono' => $faker->e164PhoneNumber,
      'fechaNac' => $faker->date($format = 'Y-m-d'),
        'direccion' => $faker->address(),
      'genero'  => 'M'
    ];
});

/**
 * Factory para las ligas
 */
$factory->define(App\Liga::class, function (Faker\Generator $faker) {
    $usuario_id = App\User::orderBy(DB::raw('RAND()'))->first();
    return [
        'usuario_id' => $usuario_id->id,
        'nombre' => $faker->name,
        'img' => $faker->url,
        'descripcion' => $faker->text,
        'fecha_ini' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'fecha_fin' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'telefono' => $faker->tollFreePhoneNumber,
        'direccion' => $faker->address,
        'categoria' => $faker->title,
        'valor_inscrip' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10000, $max = 999999),
        'valor_ama' => $faker->randomFloat($nbMaxDecimals = 2, $min = 5000, $max = 100000),
        'valor_roja' => $faker->randomFloat($nbMaxDecimals = 2, $min = 5000, $max = 100000),
        'campeon_id' => $faker->randomNumber($nbDigits = 2, $strict = false),
        'subcampeon_id' => $faker->randomNumber($nbDigits = 2, $strict = false),
        'reglas' => $faker->text($maxNbChars = 200),
        'estado' => 1
    ];
});


/**
 * Factory para los grupos
 */
$factory->define(App\Grupo::class, function (Faker\Generator $faker) {
    return [
        'nombre' => $faker->name,
        'clasifican' => $faker->numberBetween($min = 1, $max = 8),
    ];
});

/**
 * Factory para la relación grupos ligas
 */
$factory->define(App\LigaGrupo::class, function (Faker\Generator $faker) {
    // Se crea el grupo
    $grupo_id = function (){
        return factory(App\Grupo::class)->create()->id;
    };
    // Obtener una liga randon del usuario
    $liga_id = App\Liga::orderBy(DB::raw('RAND()'))->first();
    return [
        'liga_id' => $liga_id->id,
        'grupo_id' => $grupo_id
    ];
});

/**
 * Factory para los equipos
 */
$factory->define(App\Equipo::class, function (Faker\Generator $faker) {
    return [
        'nombre' => $faker->lastName(),
        'escudo' => $faker->url,
        'delegado_id' => NULL
    ];
});

/**
 * Factory para relacionar los equipos.
 */
$factory->define(App\EquipoGrupo::class, function (Faker\Generator $faker) {
    // Se crea el equipo
    $equipo_id = function (){
        return factory(App\Equipo::class)->create()->id;
    };
    // Obtener un grupo aleatorio
    $grupo_id = App\Grupo::orderBy(DB::raw('RAND()'))->first();

    // Obtener una liga randon del usuario
    $liga_id = App\Liga::orderBy(DB::raw('RAND()'))->first();

    return [
        'liga_id' => $liga_id->id,
        'grupo_id' => $grupo_id->id,
        'equipo_id' => $equipo_id,
        'posicion' => 0
    ];
});