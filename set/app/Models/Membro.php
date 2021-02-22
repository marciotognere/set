<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Membro
 * 
 * @property string $cpfAluno
 * @property int $codGrupoEstudo
 * @property Carbon $inicioMembro
 * @property string $admMembro
 * 
 * @property Aluno $aluno
 * @property Grupoestudo $grupoestudo
 *
 * @package App\Models
 */
class Membro extends Model
{
	protected $table = 'membro';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'codGrupoEstudo' => 'int'
	];

	protected $dates = [
		'inicioMembro'
	];

	protected $fillable = [
		'inicioMembro',
		'admMembro'
	];

	public function aluno()
	{
		return $this->belongsTo(Aluno::class, 'cpfAluno');
	}

	public function grupoestudo()
	{
		return $this->belongsTo(Grupoestudo::class, 'codGrupoEstudo');
	}
}
