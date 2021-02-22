<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAtividadeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('atividade', function(Blueprint $table)
		{
			$table->integer('codAtividade', true);
			$table->string('nomeAtividade', 150);
			$table->text('descrAtividade', 65535)->nullable();
			$table->char('cpfAluno', 11)->index('fk_atividade_aluno');
			$table->integer('codGrupoEstudo')->index('fk_atividade_grupoEstudo');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('atividade');
	}

}
