<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participantes',function(Blueprint $table)
        {
            $table->foreign('persona_id','fk_participantes_personas_id')
                ->references('id')
                ->on('personas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('liga_id','fk_participantes_ligas_id')
                ->references('id')
                ->on('ligas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('tipo_usuario_id','fk_participantes_tipos_usuarios_id')
                ->references('id')
                ->on('tipos_usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participantes',function(Blueprint $table)
        {
          $table->dropForeign('fk_participantes_personas_id');
          $table->dropForeign('fk_participantes_ligas_id');
          $table->dropForeign('fk_participantes_tipos_usuarios_id');
        });
    }
}
