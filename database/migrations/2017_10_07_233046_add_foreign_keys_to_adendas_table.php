<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAdendasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('adendas', function(Blueprint $table)
		{
			$table->foreign('solicitud_id', 'fk_adendas_solicitudes1')->references('id')->on('solicitudes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('usuario_id', 'fk_adendas_usuario_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('adendas', function(Blueprint $table)
		{
			$table->dropForeign('fk_adendas_solicitudes1');
			$table->dropForeign('fk_adendas_usuario_id');
		});
	}

}
