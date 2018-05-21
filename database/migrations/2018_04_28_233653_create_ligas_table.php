<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLigasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligas', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('usuario_id')->index('fk_ligas_usuario_id')->unsigned()->nullable();
            $table->string('img')->nullable();
            $table->string('nombre');
            $table->longText('descripcion')->nullable();
            $table->date('fecha_ini');
            $table->date('fecha_fin');
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->string('categoria')->nullable();
            $table->string('valor_inscrip')->nullable();
            $table->string('valor_ama')->nullable();
            $table->string('valor_roja')->nullable();
            $table->integer('campeon_id')->index('fk_ligas_equipo_campeon_id')->unsigned()->nullable();
            $table->integer('subcampeon_id')->index('fk_ligas_equipo_subcampeon_id')->unsigned()->nullable();
            $table->longText('reglas')->nullable();
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
        Schema::drop('ligas');
    }
}
