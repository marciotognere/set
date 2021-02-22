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
 * @property int $codDisciplina
 * @property string $cpfMonitor
 * @property string $cpfAluno
 * @property Collection|Monitor[] $monitores
 * @property Collection|Aluno[] $alunos
 *
 * @package App\Models
 */
class Monitoria extends Model
{
	protected $table = 'monitoria';
	protected $primaryKey = ['codDisciplina','cpfMonitor','cpfAluno'];
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'codDisciplina'   => 'int'
	];

	protected $fillable = [
		'cpfAluno',
		'codDisciplina',
		'cpfMonitor'
	];

	// public function monitorias()
	// {
	// 	return $this->belongsTo(Monitor::class, 'codDisciplina');
	// }
	//
	// public function aluno()
	// {
	// 	return $this->belongsTo(Aluno::class, 'cpfAluno');
	// }
}
