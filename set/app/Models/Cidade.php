<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cidade
 * 
 * @property int $codCidade
 * @property string $nomeCidade
 * @property string $ufEstado
 * 
 * @property Estado $estado
 * @property Collection|Aluno[] $alunos
 * @property Collection|Instituicao[] $instituicaos
 *
 * @package App\Models
 */
class Cidade extends Model
{
	protected $table = 'cidade';
	protected $primaryKey = 'codCidade';
	public $timestamps = false;

	protected $fillable = [
		'nomeCidade',
		'ufEstado'
	];

	public function estado()
	{
		return $this->belongsTo(Estado::class, 'ufEstado');
	}

	public function alunos()
	{
		return $this->hasMany(Aluno::class, 'codCidade');
	}

	public function instituicaos()
	{
		return $this->hasMany(Instituicao::class, 'codCidade');
	}
}
