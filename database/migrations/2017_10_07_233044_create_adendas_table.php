<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdendasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('adendas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('codigo',10);
			$table->integer('solicitud_id')->index('fk_adendas_solicitudes1_idx')->unsigned();
			$table->integer('usuario_id')->index('fk_adendas_usuario_id')->unsigned();
			$table->string('nombre', 45);
			$table->string('descripcion', 45);
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
		Schema::drop('adendas');
	}

}
