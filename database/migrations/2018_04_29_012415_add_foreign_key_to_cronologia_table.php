<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToCronologiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cronologia',function(Blueprint $table)
        {
            $table->foreign('fecha_id','fk_cronologia_fechas_id')
                ->references('id')->on('fechas')
                ->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('liga_id','fk_cronologia_ligas_id')
                ->references('id')->on('ligas')
                ->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cronologia',function(Blueprint $table)
        {
          $table->dropForeign('fk_cronologia_fechas_id');
          $table->dropForeign('fk_cronologia_ligas_id');
        });
    }
}
