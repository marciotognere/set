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
 * @property int $codRanque
 * @property int $pontoRanque
 * @property Collection|Grupoestudo[] $grupoestudo
 * @property Collection|Aluno[] $alunos
 *
 * @package App\Models
 */
class Ranque extends Model
{
	protected $table = 'ranque';
	protected $primaryKey = 'codRanque';
	public $timestamps = false;

	protected $casts = [
		'pontoRanque' => 'int'
	];

	protected $fillable = [
		'codRanque',
		'cpfAluno',
		'codGrupoEstudo',
		'pontoRanque'
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
