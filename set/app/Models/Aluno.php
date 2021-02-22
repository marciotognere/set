<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Autenticacao;

/**
 * Class Aluno
 *
 * @property string $cpfAluno
 * @property string $nomeAluno
 * @property string $emailAluno
 * @property string $celularAluno
 * @property string $senhaAluno
 * @property string $dataNascAluno
 * @property string $cepAluno
 * @property int $codCidade
 *
 * @property Cidade $cidade
 * @property Collection|Atividade[] $atividades
 * @property Collection|Avaliacao[] $avaliacaos
 * @property Collection|Estilo[] $estilos
 * @property Collection|Matricula[] $matriculas
 * @property Collection|Membro[] $membros
 * @property Collection|Respostaavaliacao[] $respostaavaliacaos
 * @property Collection|Seguidor[] $seguidors
 * @property Collection|Monitor[] $monitores
 *
 * @package App\Models
 */
class Aluno extends Autenticacao
{

	protected $guarded = ['cpfAluno'];
  protected $hidden = [
  	'senhaAluno',
  ];

	public function getAuthPassword()
  {
   	return $this->senhaAluno;
  }

	protected $table = 'aluno';
	protected $primaryKey = 'cpfAluno';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'codCidade' => 'int'
	];

	protected $fillable = [
		'nomeAluno',
		'emailAluno',
		'celularAluno',
		'senhaAluno',
		'dataNascAluno',
		'cepAluno',
		'codCidade'
	];

	public function cidade()
	{
		return $this->belongsTo(Cidade::class, 'codCidade');
	}

	public function atividades()
	{
		return $this->hasMany(Atividade::class, 'cpfAluno');
	}

	public function avaliacaos()
	{
		return $this->hasMany(Avaliacao::class, 'cpfAluno');
	}

	public function estilos()
	{
		return $this->hasMany(Estilo::class, 'cpfAluno');
	}

	public function matriculas()
	{
		return $this->hasMany(Matricula::class, 'cpfAluno');
	}

	public function membros()
	{
		return $this->hasMany(Membro::class, 'cpfAluno');
	}

	public function respostaavaliacaos()
	{
		return $this->hasMany(Respostaavaliacao::class, 'cpfAluno');
	}

	public function seguidors()
	{
		return $this->hasMany(Seguidor::class, 'seguido');
	}

	public function monitores()
	{
		return $this->hasMany(Monitor::class, 'cpfAluno');
	}
}
