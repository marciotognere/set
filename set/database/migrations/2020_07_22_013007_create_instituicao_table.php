<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstituicaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('instituicao', function(Blueprint $table)
		{
			$table->integer('codInstituicao', true);
			$table->string('nomeInstituicao', 175);
			$table->integer('codCidade')->index('fk_instituicao_cidade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('instituicao');
	}

}
