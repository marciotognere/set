<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Atividade
 * 
 * @property int $codAtividade
 * @property string $nomeAtividade
 * @property string $descrAtividade
 * @property Carbon $dataAtividade
 * @property string $cpfAluno
 * @property int $codGrupoEstudo
 * 
 * @property Aluno $aluno
 * @property Grupoestudo $grupoestudo
 * @property Collection|Avaliacao[] $avaliacaos
 * @property Collection|Questao[] $questaos
 * @property Collection|Respostaavaliacao[] $respostaavaliacaos
 *
 * @package App\Models
 */
class Atividade extends Model
{
	protected $table = 'atividade';
	protected $primaryKey = 'codAtividade';
	public $timestamps = false;

	protected $casts = [
		'codGrupoEstudo' => 'int'
	];

	protected $dates = [
		'dataAtividade'
	];

	protected $fillable = [
		'nomeAtividade',
		'descrAtividade',
		'dataAtividade',
		'cpfAluno',
		'codGrupoEstudo'
	];

	public function aluno()
	{
		return $this->belongsTo(Aluno::class, 'cpfAluno');
	}

	public function grupoestudo()
	{
		return $this->belongsTo(Grupoestudo::class, 'codGrupoEstudo');
	}

	public function avaliacaos()
	{
		return $this->hasMany(Avaliacao::class, 'codAtividade');
	}

	public function questaos()
	{
		return $this->hasMany(Questao::class, 'codAtividade');
	}

	public function respostaavaliacaos()
	{
		return $this->hasMany(Respostaavaliacao::class, 'codAtividade');
	}
}
