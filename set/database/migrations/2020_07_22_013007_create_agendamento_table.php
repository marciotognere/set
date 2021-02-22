<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAgendamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('agendamento', function(Blueprint $table)
		{
			$table->integer('codAgendamento', true);
			$table->integer('codLocal')->index('fk_agendamento_local');
			$table->integer('codGrupoEstudo')->index('fk_agendamento_grupoEstudo');
			$table->string('nomeAgendamento', 80);
			$table->text('descrAgendamento', 65535)->nullable();
			$table->date('dataAgendamento');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('agendamento');
	}

}
