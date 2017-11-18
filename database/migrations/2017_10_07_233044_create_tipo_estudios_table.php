<?php

use App\Tipo_Estudio;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoEstudiosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipos_estudios', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 45);
			$table->timestamps();
		});

		// Organizar datos.
		$tipos_estudios = [
			['nombre' => 'Taller'],
			['nombre' => 'Curso'],
			['nombre' => 'Técnico Profesional'],
			['nombre' => 'Tecnológico'],
			['nombre' => 'Profesional'],
			['nombre' => 'Especialización'],
			['nombre' => 'Maestría'],
			['nombre' => 'Doctorado'],
		];
		// Insertar datos
		foreach ($tipos_estudios as $indice => $tipo_estudio) {
			Tipo_Estudio::create($tipo_estudio);
		}
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tipos_estudios');
	}

}
