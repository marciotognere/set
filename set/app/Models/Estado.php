<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Estado
 * 
 * @property string $ufEstado
 * @property string $nomeEstado
 * 
 * @property Collection|Cidade[] $cidades
 *
 * @package App\Models
 */
class Estado extends Model
{
	protected $table = 'estado';
	protected $primaryKey = 'ufEstado';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'nomeEstado'
	];

	public function cidades()
	{
		return $this->hasMany(Cidade::class, 'ufEstado');
	}
}
