<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyLigasGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ligas_grupos',function(Blueprint $table)
        {
            $table->foreign('liga_id','fk_ligas_grupos_liga_id')->references('id')->on('ligas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('grupo_id','fk_ligas_grupos_grupo_id')->references('id')->on('grupos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ligas_grupos',function(Blueprint $table)
        {
          $table->dropForeign('fk_ligas_grupos_liga_id');
          $table->dropForeign('fk_ligas_grupos_grupo_id');
        });
    }
}
