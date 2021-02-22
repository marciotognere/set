<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Avaliacao
 * 
 * @property int $codAtividade
 * @property string $cpfAluno
 * @property int $codGrupoEstudo
 * @property int $notaAvaliacao
 * 
 * @property Aluno $aluno
 * @property Atividade $atividade
 * @property Grupoestudo $grupoestudo
 *
 * @package App\Models
 */
class Avaliacao extends Model
{
	protected $table = 'avaliacao';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'codAtividade' => 'int',
		'codGrupoEstudo' => 'int',
		'notaAvaliacao' => 'int'
	];

	protected $fillable = [
		'notaAvaliacao'
	];

	public function aluno()
	{
		return $this->belongsTo(Aluno::class, 'cpfAluno');
	}

	public function atividade()
	{
		return $this->belongsTo(Atividade::class, 'codAtividade');
	}

	public function grupoestudo()
	{
		return $this->belongsTo(Grupoestudo::class, 'codGrupoEstudo');
	}
}
