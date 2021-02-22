<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAvaliacaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('avaliacao', function(Blueprint $table)
		{
			$table->integer('codAtividade');
			$table->char('cpfAluno', 11)->index('fk_avaliacao_aluno');
			$table->integer('codGrupoEstudo')->index('fk_avaliacao_grupoEstudo');
			$table->integer('notaAvaliacao');
			$table->primary(['codAtividade','cpfAluno','codGrupoEstudo']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('avaliacao');
	}

}
