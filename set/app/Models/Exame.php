<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Exame
 * 
 * @property int $codExame
 * @property string $descrExame
 * @property int $codTipoEstilo
 * 
 * @property Tipoestilo $tipoestilo
 * @property Collection|Estilo[] $estilos
 *
 * @package App\Models
 */
class Exame extends Model
{
	protected $table = 'exame';
	protected $primaryKey = 'codExame';
	public $timestamps = false;

	protected $casts = [
		'codTipoEstilo' => 'int'
	];

	protected $fillable = [
		'descrExame',
		'codTipoEstilo'
	];

	public function tipoestilo()
	{
		return $this->belongsTo(Tipoestilo::class, 'codTipoEstilo');
	}

	public function estilos()
	{
		return $this->hasMany(Estilo::class, 'codExame');
	}
}
