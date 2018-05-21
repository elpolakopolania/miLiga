<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCronologiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cronologia', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('fecha_id')->index('fk_cronologia_fechas_id')->unsigned();
            $table->integer('liga_id')->index('fk_cronologia_ligas_id')->unsigned();
            $table->integer('equipo1_id')->index('fk_cronologia_equipo1_id')->unsigned();
            $table->integer('equipo2_id')->index('fk_cronologia_equipo2_id')->unsigned();
            $table->integer('participante1_id')->index('fk_cronologiaa_participante1_id')->unsigned();
            $table->integer('participante2_id')->index('fk_cronologia_participante2_id')->unsigned();
            $table->string('cod',2);
            $table->time('tiempo_juego');
            $table->time('descripcion');
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
        Schema::drop('cronologia');
    }
}
