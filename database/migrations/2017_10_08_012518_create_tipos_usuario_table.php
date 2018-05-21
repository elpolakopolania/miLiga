<?php

use App\Tipo_Usuario;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Crear tabla.
        Schema::create('tipos_usuarios', function(Blueprint $table)
    		{
    			$table->increments('id');
    			$table->string('nombre', 45);
          $table->timestamps();
    		});

        // Organizar datos.
        $tipos_usuarios = [
          ['nombre' => 'Root'],
          ['nombre' => 'Administrador'],
          ['nombre' => 'Jugador'],
          ['nombre' => 'Delegado']
        ];
        // Insertar datos
        foreach ($tipos_usuarios as $indice => $tipo_usuario) {
          Tipo_Usuario::create($tipo_usuario);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tipos_usuarios');
    }
}
