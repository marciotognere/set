<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Curso
 * 
 * @property int $codCurso
 * @property string $nomeCurso
 * @property int $codInstituicao
 * 
 * @property Instituicao $instituicao
 * @property Collection|Grade[] $grades
 * @property Collection|Matricula[] $matriculas
 *
 * @package App\Models
 */
class Curso extends Model
{
	protected $table = 'curso';
	protected $primaryKey = 'codCurso';
	public $timestamps = false;

	protected $casts = [
		'codInstituicao' => 'int'
	];

	protected $fillable = [
		'nomeCurso',
		'codInstituicao'
	];

	public function instituicao()
	{
		return $this->belongsTo(Instituicao::class, 'codInstituicao');
	}

	public function grades()
	{
		return $this->hasMany(Grade::class, 'codCurso');
	}

	public function matriculas()
	{
		return $this->hasMany(Matricula::class, 'codCurso');
	}
}
