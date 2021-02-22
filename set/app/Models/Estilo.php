<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Estilo
 * 
 * @property string $cpfAluno
 * @property int $codExame
 * @property Carbon $dataEstilo
 * @property int $notaEstilo
 * @property int $etapaEstilo
 * 
 * @property Aluno $aluno
 * @property Exame $exame
 *
 * @package App\Models
 */
class Estilo extends Model
{
	protected $table = 'estilo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'codExame' => 'int',
		'notaEstilo' => 'int',
		'etapaEstilo' => 'int'
	];

	protected $dates = [
		'dataEstilo'
	];

	protected $fillable = [
		'notaEstilo',
		'etapaEstilo'
	];

	public function aluno()
	{
		return $this->belongsTo(Aluno::class, 'cpfAluno');
	}

	public function exame()
	{
		return $this->belongsTo(Exame::class, 'codExame');
	}
}
