<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyLigasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ligas',function(Blueprint $table)
        {
            $table->foreign('usuario_id','fk_ligas_user_id')
                ->references('id')
                ->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ligas',function(Blueprint $table)
        {
          $table->dropForeign('fk_ligas_user_id');
        });
    }
}
