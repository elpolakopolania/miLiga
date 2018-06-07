<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participantes', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('persona_id')->index('fk_participantes_personas_id')->unsigned();
            $table->integer('liga_id')->index('fk_participantes_ligas_id')->unsigned();
            $table->integer('equipo_id');
            $table->integer('tipo_usuario_id')->index('fk_participantes_tipos_usuarios_id')->unsigned();
            $table->integer('num_camiseta')->nullable();
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
        Schema::drop('participantes');
    }
}
