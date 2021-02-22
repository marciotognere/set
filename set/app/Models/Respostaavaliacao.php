<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Respostaavaliacao
 * 
 * @property int $codAlternativa
 * @property int $codAtividade
 * @property string $cpfAluno
 * @property int $codGrupoEstudo
 * 
 * @property Grupoestudo $grupoestudo
 * @property Alternativa $alternativa
 * @property Aluno $aluno
 * @property Atividade $atividade
 *
 * @package App\Models
 */
class Respostaavaliacao extends Model
{
	protected $table = 'respostaavaliacao';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'codAlternativa' => 'int',
		'codAtividade' => 'int',
		'codGrupoEstudo' => 'int'
	];

	public function grupoestudo()
	{
		return $this->belongsTo(Grupoestudo::class, 'codGrupoEstudo');
	}

	public function alternativa()
	{
		return $this->belongsTo(Alternativa::class, 'codAlternativa');
	}

	public function aluno()
	{
		return $this->belongsTo(Aluno::class, 'cpfAluno');
	}

	public function atividade()
	{
		return $this->belongsTo(Atividade::class, 'codAtividade');
	}
}
