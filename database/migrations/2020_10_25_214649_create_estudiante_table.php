<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstudianteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estudiante', function(Blueprint $table)
		{
			$table->increments('id_estudiante');
			$table->string('documento', 15)->comment('DNI/CE');
			$table->string('codigo_estudiante', 14);
			$table->string('apellido_paterno', 40);
			$table->string('apellido_materno', 40);
			$table->string('nombres', 40);
			$table->date('fecha_nacimiento');
			$table->string('estado_matricula',30);
			$table->string('tipo_vacante',30)->nullable();
			$table->enum('sexo', ['Mujer','Varon'])->comment('sexo');
			$table->enum('nivel', ['INICIAL','PRIMARIA','SECUNDARIA'])->comment('nivel educativo');
			$table->string('grado', 20);
			$table->string('seccion', 1);
            $table->dateTime('fecha_registro');
            $table->dateTime('fecha_actualizacion');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('estudiante');
	}

}
