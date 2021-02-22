<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Situacao
 * 
 * @property int $codSituacao
 * @property string $nomeSituacao
 * 
 * @property Collection|Matricula[] $matriculas
 *
 * @package App\Models
 */
class Situacao extends Model
{
	protected $table = 'situacao';
	protected $primaryKey = 'codSituacao';
	public $timestamps = false;

	protected $fillable = [
		'nomeSituacao'
	];

	public function matriculas()
	{
		return $this->hasMany(Matricula::class, 'codSituacao');
	}
}
