<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposEquposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos_equipos', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('liga_id')->index('fk_grupos_equipos_ligas_id')->unsigned();
            $table->integer('grupo_id')->index('fk_grupos_equipos_grupos_id')->unsigned();
            $table->integer('equipo_id')->index('fk_grupos_equipos_equipos_id')->unsigned();
            $table->integer('posicion');
            $table->integer('estado')->comment('O eliminado, 1 clasificado, 2 jugando')->default(2);
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
        Schema::drop('grupos_equipos');
    }
}
