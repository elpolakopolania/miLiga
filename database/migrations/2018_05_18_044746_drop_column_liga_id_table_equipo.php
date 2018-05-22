<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnLigaIdTableEquipo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipos', function (Blueprint $table) {
            //$table->dropForeign('fk_equipos_ligas_id');
            //$table->dropColumn(['liga_id']);
        });
    }

    /**fk_equipos_ligas_id
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipos', function (Blueprint $table) {
            //$table->integer('liga_id')->index('fk_equipos_ligas_id')->unsigned();
        });
    }
}
