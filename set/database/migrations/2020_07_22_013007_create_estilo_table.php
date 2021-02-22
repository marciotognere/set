<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstiloTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estilo', function(Blueprint $table)
		{
			$table->char('cpfAluno', 11);
			$table->integer('codExame')->index('fk_estilo_exame');
			$table->date('dataEstilo');
			$table->integer('notaEstilo');
			$table->integer('etapaEstilo');
			$table->primary(['cpfAluno','codExame','dataEstilo']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('estilo');
	}

}
