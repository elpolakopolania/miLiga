<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nombre');
            $table->string('escudo');
            $table->integer('delegado_id')->index('fk_equipos_participantes_id')->unsigned();
            $table->integer('liga_id')->index('fk_equipos_ligas_id')->unsigned();
            $table->integer('estado')->comment('O inactivo, 1 activo')->default(1);
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
        Schema::drop('equipos');
    }
}
