<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGradeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('grade', function(Blueprint $table)
		{
			$table->integer('codDisciplina');
			$table->integer('codCurso')->index('fk_grade_curso');
			$table->integer('periodoGrade');
			$table->char('anoGrade', 4);
			$table->primary(['codDisciplina','codCurso']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('grade');
	}

}
