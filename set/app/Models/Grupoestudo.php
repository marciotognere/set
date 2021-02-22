<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Grupoestudo
 * 
 * @property int $codGrupoEstudo
 * @property string $nomeGrupoEstudo
 * @property string $descrGrupoEstudo
 * @property int $numVagasGrupoEstudo
 * @property int $codDisciplina
 * 
 * @property Disciplina $disciplina
 * @property Collection|Agendamento[] $agendamentos
 * @property Collection|Atividade[] $atividades
 * @property Collection|Avaliacao[] $avaliacaos
 * @property Collection|Membro[] $membros
 * @property Collection|Respostaavaliacao[] $respostaavaliacaos
 *
 * @package App\Models
 */
class Grupoestudo extends Model
{
	protected $table = 'grupoestudo';
	protected $primaryKey = 'codGrupoEstudo';
	public $timestamps = false;

	protected $casts = [
		'numVagasGrupoEstudo' => 'int',
		'codDisciplina' => 'int'
	];

	protected $fillable = [
		'nomeGrupoEstudo',
		'descrGrupoEstudo',
		'numVagasGrupoEstudo',
		'codDisciplina'
	];

	public function disciplina()
	{
		return $this->belongsTo(Disciplina::class, 'codDisciplina');
	}

	public function agendamentos()
	{
		return $this->hasMany(Agendamento::class, 'codGrupoEstudo');
	}

	public function atividades()
	{
		return $this->hasMany(Atividade::class, 'codGrupoEstudo');
	}

	public function avaliacaos()
	{
		return $this->hasMany(Avaliacao::class, 'codGrupoEstudo');
	}

	public function membros()
	{
		return $this->hasMany(Membro::class, 'codGrupoEstudo');
	}

	public function respostaavaliacaos()
	{
		return $this->hasMany(Respostaavaliacao::class, 'codGrupoEstudo');
	}
}
