<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Matricula
 * 
 * @property int $codCurso
 * @property string $cpfAluno
 * @property Carbon $dataInicioCurso
 * @property Carbon $dataFimCurso
 * @property int $codSituacao
 * 
 * @property Aluno $aluno
 * @property Curso $curso
 * @property Situacao $situacao
 *
 * @package App\Models
 */
class Matricula extends Model
{
	protected $table = 'matricula';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'codCurso' => 'int',
		'codSituacao' => 'int'
	];

	protected $dates = [
		'dataInicioCurso',
		'dataFimCurso'
	];

	protected $fillable = [
		'dataInicioCurso',
		'dataFimCurso',
		'codSituacao'
	];

	public function aluno()
	{
		return $this->belongsTo(Aluno::class, 'cpfAluno');
	}

	public function curso()
	{
		return $this->belongsTo(Curso::class, 'codCurso');
	}

	public function situacao()
	{
		return $this->belongsTo(Situacao::class, 'codSituacao');
	}
}
