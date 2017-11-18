<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstudiosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estudios', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tipo_estudio_id')->index('fk_Estudios_Tipo_Estudio1_idx')->unsigned();
			$table->integer('solicitud_id')->index('fk_estudios_solicitud1_idx')->unsigned();
			$table->string('nombre_institucion', 45);
			$table->string('nombre_carrera', 45);
			$table->string('nombre_archivo', 255);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('estudios');
	}

}
