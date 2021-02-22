<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questao', function(Blueprint $table)
		{
			$table->integer('codQuestao', true);
			$table->text('descrQuestao', 65535);
			$table->string('imagemQuestao', 100)->nullable();
			$table->integer('codAtividade')->index('fk_questao_atividade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('questao');
	}

}
