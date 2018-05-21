<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLigasGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligas_grupos', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('liga_id')->index('fk_ligas_grupos_liga_id')->unsigned();
            $table->integer('grupo_id')->index('fk_ligas_grupos_grupo_id')->unsigned();
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
        Schema::drop('ligas_grupos');
    }
}
