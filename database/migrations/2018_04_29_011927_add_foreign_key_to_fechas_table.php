<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToFechasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fechas',function(Blueprint $table)
        {
            $table->foreign('liga_id','fk_fechas_ligas_id')
                ->references('id')->on('ligas')
                ->onUpdate('NO ACTION')->onDelete('NO ACTION');
            /*$table->foreign('equipo1_id','fk_fechas_equipo1_id')
                ->references('id')->on('equipos')
                ->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('equipo2_id','fk_fechas_equipo2_id')
                ->references('id')->on('equipos')
                ->onUpdate('NO ACTION')->onDelete('NO ACTION');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fechas',function(Blueprint $table)
        {
          $table->dropForeign('fk_fechas_ligas_id');
          /*$table->dropForeign('fk_fechas_equipo1_id');
          $table->dropForeign('fk_fechas_equipo2_id');*/
        });
    }
}
