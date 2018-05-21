<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKetToGruposEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grupos_equipos',function(Blueprint $table)
        {
            $table->foreign('liga_id','fk_grupos_equipos_ligas_id')
                ->references('id')
                ->on('ligas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('grupo_id','fk_grupos_equipos_grupos_id')
                ->references('id')
                ->on('grupos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('equipo_id','fk_grupos_equipos_equipos_id')
                ->references('id')
                ->on('equipos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grupos_equipos',function(Blueprint $table)
        {
          $table->dropForeign('fk_grupos_equipos_ligas_id');
          $table->dropForeign('fk_grupos_equipos_grupos_id');
          $table->dropForeign('fk_grupos_equipos_equipos_id');
        });
    }
}
