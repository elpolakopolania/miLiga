<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAdendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adendas', function (Blueprint $table) {
          $table->integer('estado')->length(1);
          $table->string('archivo',250)->after('descripcion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adendas', function (Blueprint $table) {
          $table->dropColumn('estado');
          $table->dropColumn('archivo');
        });
    }
}
