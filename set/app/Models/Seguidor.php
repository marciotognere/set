<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Seguidor
 * 
 * @property string $cpfAluno
 * @property string $seguido
 * 
 * @property Aluno $aluno
 *
 * @package App\Models
 */
class Seguidor extends Model
{
	protected $table = 'seguidor';
	public $incrementing = false;
	public $timestamps = false;

	public function aluno()
	{
		return $this->belongsTo(Aluno::class, 'seguido');
	}
}
