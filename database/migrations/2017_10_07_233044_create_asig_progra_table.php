<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsigPrograTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asig_progra', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('asignatura_id')->index('asig_progra_asignatura_id_foreign')->unsigned();
			$table->integer('programa_id')->index('asig_progra_programa_id_foreign')->unsigned();
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
		Schema::drop('asig_progra');
	}

}
