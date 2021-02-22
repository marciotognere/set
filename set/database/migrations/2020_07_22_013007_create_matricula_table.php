<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatriculaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matricula', function(Blueprint $table)
		{
			$table->integer('codCurso');
			$table->char('cpfAluno', 11)->index('fk_matricula_aluno');
			$table->date('dataInicioCurso');
			$table->date('dataFimCurso');
			$table->integer('codSituacao')->index('fk_matricula_situacao');
			$table->primary(['codCurso','cpfAluno']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matricula');
	}

}
