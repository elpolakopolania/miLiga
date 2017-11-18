<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHomologacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('homologaciones', function(Blueprint $table)
		{
			$table->foreign('adendas_id', 'fk_homologaciones_adendas1')->references('id')->on('adendas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('asig_progra_id', 'fk_homologaciones_asig_progra1')->references('id')->on('asig_progra')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('homologaciones', function(Blueprint $table)
		{
			$table->dropForeign('fk_homologaciones_adendas1');
			$table->dropForeign('fk_homologaciones_asig_progra1');
		});
	}

}
