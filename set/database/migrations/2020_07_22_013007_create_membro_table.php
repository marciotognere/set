<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembroTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('membro', function(Blueprint $table)
		{
			$table->char('cpfAluno', 11);
			$table->integer('codGrupoEstudo')->index('fk_membro_grupoEstudo');
			$table->date('inicioMembro');
			$table->char('admMembro', 1)->nullable();
			$table->primary(['cpfAluno','codGrupoEstudo']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('membro');
	}

}
