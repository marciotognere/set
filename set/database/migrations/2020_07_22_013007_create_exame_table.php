<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExameTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exame', function(Blueprint $table)
		{
			$table->integer('codExame', true);
			$table->text('descrExame', 65535);
			$table->integer('codTipoEstilo')->index('fk_exame_tipoEstilo');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('exame');
	}

}
