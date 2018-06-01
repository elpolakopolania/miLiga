<?php

use App\TipoDocumento;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoDocumentosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipos_documentos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->char('codigo', 2)->unique();
			$table->string('nombre');
            $table->integer('estado')->comment('O inactivo, 1 activo')->default(1);
			$table->timestamps();
		});

		// Organizar datos.
		$tipos_documentos = [
			['codigo' => 'RC','nombre' => 'Registro Civil',],
			['codigo' => 'TI','nombre' => 'Tarjeta de identidad'],
			['codigo' => 'CC','nombre' => 'Cédula de ciudadanía'],
			['codigo' => 'CE','nombre' => 'Cédula de extranjería'],
			['codigo' => 'P','nombre' => 'Pasaporte'],
		];
		// Insertar datos
		foreach ($tipos_documentos as $indice => $tipo_documento) {
			TipoDocumento::create($tipo_documento);
		}
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tipos_documentos');
	}

}
