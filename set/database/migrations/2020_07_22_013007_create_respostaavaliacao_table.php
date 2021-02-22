<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRespostaavaliacaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('respostaavaliacao', function(Blueprint $table)
		{
			$table->integer('codAlternativa');
			$table->integer('codAtividade')->index('fk_respostaAvaliacao_atividade');
			$table->char('cpfAluno', 11)->index('fk_respostaAvaliacao_aluno');
			$table->integer('codGrupoEstudo')->index('fk_fk_respostaAvaliacao_grupoEstudo');
			$table->primary(['codAlternativa','codAtividade','cpfAluno','codGrupoEstudo']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('respostaavaliacao');
	}

}
