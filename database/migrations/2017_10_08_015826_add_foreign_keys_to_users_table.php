<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function(Blueprint $table)
        {
          $table->foreign('tipo_usuario_id','fk_users_tipos_usuarios_id')->references('id')->on('tipos_usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
          $table->foreign('persona_id','fk_users_personas_id')->references('id')->on('personas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users',function(Blueprint $table)
        {
          $table->dropForeign('fk_users_tipos_usuarios_id');
          $table->dropForeign('fk_users_personas_id');
        });
    }
}
