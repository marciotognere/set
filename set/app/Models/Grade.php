<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Grade
 *
 * @property int $codDisciplina
 * @property int $codCurso
 * @property int $periodoGrade
 * @property string $anoGrade
 *
 * @property Curso $curso
 * @property Disciplina $disciplina
 *
 * @package App\Models
 */
class Grade extends Model
{
	protected $table = 'grade';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'codDisciplina' => 'int',
		'codCurso' => 'int',
		'periodoGrade' => 'int'
	];

	protected $fillable = [
		'periodoGrade',
		'anoGrade'
	];

	public function cursos()
	{
		return $this->belongsTo(Curso::class, 'codCurso');
	}

	public function disciplinas()
	{
		return $this->belongsTo(Disciplina::class, 'codDisciplina');
	}
}
