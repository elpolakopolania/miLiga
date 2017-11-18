<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomologacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('homologaciones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('adendas_id')->index('fk_homologaciones_adendas1_idx')->unsigned();
			$table->integer('asig_progra_id')->index('fk_homologaciones_asig_progra1_idx')->unsigned();
			$table->string('nota', 45);
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
		Schema::drop('homologaciones');
	}

}
