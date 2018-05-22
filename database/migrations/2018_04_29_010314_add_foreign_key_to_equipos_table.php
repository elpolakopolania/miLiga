<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipos',function(Blueprint $table)
        {
            /*$table->foreign('delegado_id','fk_equipos_participantes_id')
                ->references('id')
                ->on('personas')->onUpdate('NO ACTION')->onDelete('NO ACTION'); */
            /*$table->foreign('liga_id','fk_equipos_ligas_id')
                ->references('id')
                ->on('ligas')->onUpdate('NO ACTION')->onDelete('NO ACTION');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipos',function(Blueprint $table)
        {
          //$table->dropForeign('fk_equipos_participantes_id');
          //$table->dropForeign('fk_equipos_ligas_id');
        });
    }
}
