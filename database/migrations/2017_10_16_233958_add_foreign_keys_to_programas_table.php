<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToProgramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('programas',function(Blueprint $table)
      {
        $table->foreign('jefe_id','fk_programa_user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('programas',function(Blueprint $table)
      {
        $table->dropForeign('fk_programa_user_id');
      });
    }
}
