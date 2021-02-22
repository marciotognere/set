<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Instituicao
 * 
 * @property int $codInstituicao
 * @property string $nomeInstituicao
 * @property int $codCidade
 * 
 * @property Cidade $cidade
 * @property Collection|Curso[] $cursos
 *
 * @package App\Models
 */
class Instituicao extends Model
{
	protected $table = 'instituicao';
	protected $primaryKey = 'codInstituicao';
	public $timestamps = false;

	protected $casts = [
		'codCidade' => 'int'
	];

	protected $fillable = [
		'nomeInstituicao',
		'codCidade'
	];

	public function cidade()
	{
		return $this->belongsTo(Cidade::class, 'codCidade');
	}

	public function cursos()
	{
		return $this->hasMany(Curso::class, 'codInstituicao');
	}
}
