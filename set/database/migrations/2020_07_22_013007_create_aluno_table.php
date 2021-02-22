<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlunoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aluno', function(Blueprint $table)
		{
			$table->char('cpfAluno', 11)->primary();
			$table->string('nomeAluno', 75);
			$table->string('emailAluno', 85);
			$table->char('celularAluno', 11);
			$table->string('senhaAluno', 150);
			$table->char('dataNascAluno', 10);
			$table->char('cepAluno', 8);
			$table->integer('codCidade')->index('fk_aluno_cidade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('aluno');
	}

}
