<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlternativaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alternativa', function(Blueprint $table)
		{
			$table->integer('codAlternativa', true);
			$table->char('letraAlternativa', 1);
			$table->text('descrAlternativa', 65535);
			$table->char('certaAlternativa', 1);
			$table->integer('codQuestao')->index('fk_alternativa_questao');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('alternativa');
	}

}
