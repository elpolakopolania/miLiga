<?php
use App\Tipo_cronologia;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoCronologiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_cronologia', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('cod',2)->unique();
            $table->string('nombre');
            $table->integer('estado')->comment('O inactivo, 1 activo')->default(1);
            $table->timestamps();
        });
        
        // Organizar datos.
        $tipos_cronologias = [
            ['cod' => 'TA','nombre' => 'Tarjeta Amarrilla'],
            ['cod' => 'TR','nombre' => 'Tarjeta Roja'],
            ['cod' => 'CA','nombre' => 'Cambio'],
            ['cod' => 'FL','nombre' => 'Fuera de lugar'],
            ['cod' => 'GO','nombre' => 'Gol'],
            ['cod' => 'IN','nombre' => 'Inicio del encuentro'],
            ['cod' => 'FN','nombre' => 'Fin del encuentro'],
            ['cod' => 'TL','nombre' => 'Tiro libre'],
            ['cod' => 'TE','nombre' => 'Tiro de ezquina'],
            ['cod' => 'FT','nombre' => 'Falta']
          ];
          // Insertar datos
          foreach ($tipos_cronologias as $indice => $tipo_cronologia) {
            Tipo_cronologia::create($tipo_cronologia);
          }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tipo_cronologia');
    }
}
