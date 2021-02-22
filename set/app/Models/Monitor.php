<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Monitor
 *
 * @property string $cpfAluno
 * @property int $codDisciplina
 * @property string $diaMonitor
 * @property int $numAlunoMonitor
 * @property Collection|Disciplina[] $disciplinas
 * @property Collection|Aluno[] $alunos
 *
 * @package App\Models
 */
class Monitor extends Model
{
	protected $table = 'monitor';
	protected $primaryKey = ['codDisciplina','cpfAluno'];
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'codDisciplina'   => 'int',
		'numAlunoMonitor' => 'int'
	];

	//horaInicioMonitor
	//horaTerminoMonitor

	protected $fillable = [
		'cpfAluno',
		'codDisciplina',
		'diaMonitor',
		'numAlunoMonitor'
	];

	public function disciplinas()
	{
		return $this->belongsTo(Disciplina::class, 'codDisciplina');
	}

	public function aluno()
	{
		return $this->belongsTo(Aluno::class, 'cpfAluno');
	}
}
