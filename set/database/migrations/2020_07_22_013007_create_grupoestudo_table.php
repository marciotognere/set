<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGrupoestudoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('grupoestudo', function(Blueprint $table)
		{
			$table->integer('codGrupoEstudo', true);
			$table->string('nomeGrupoEstudo', 85);
			$table->text('descrGrupoEstudo', 65535)->nullable();
			$table->integer('numVagasGrupoEstudo');
			$table->integer('codDisciplina')->index('fk_grupoEstudo_disciplina');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('grupoestudo');
	}

}
