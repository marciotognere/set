<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDisciplinaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('disciplina', function(Blueprint $table)
		{
			$table->integer('codDisciplina', true);
			$table->string('nomeDisciplina', 115);
			$table->integer('cargaHorariaDisciplina');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('disciplina');
	}

}
