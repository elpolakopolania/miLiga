<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEstudiosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('estudios', function(Blueprint $table)
		{
			$table->foreign('tipo_estudio_id', 'fk_Estudios_Tipo_Estudio1')->references('id')->on('tipos_estudios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('solicitud_id', 'fk_estudios_solicitud1')->references('id')->on('solicitudes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('estudios', function(Blueprint $table)
		{
			$table->dropForeign('fk_Estudios_Tipo_Estudio1');
			$table->dropForeign('fk_estudios_solicitud1');
		});
	}

}
