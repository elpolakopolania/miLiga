<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFechasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fechas', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('liga_id')->index('fk_fechas_ligas_id')->unsigned();
            $table->integer('jornada_id');
            $table->integer('equipo1_id')->index('fk_fechas_equipo1_id')->unsigned();
            $table->integer('equipo2_id')->index('fk_fechas_equipo2_id')->unsigned();
            $table->integer('equipo1_goles');
            $table->integer('equipo2_goles');
            $table->date('fecha_ini');
            $table->date('fecha_fin');
            $table->integer('ganador_id')->index('fk_fechas_equipo__ganador_id')->unsigned();
            $table->integer('tipo_resultado')->comment('G jugado y ganado, W ganado por w');
            $table->integer('estado')->comment('0 por jugar, 1 terminado, 2 jugando, 3 cancelado')->default(0);
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
        Schema::drop('fechas');
    }
}
