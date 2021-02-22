<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipoestilo
 * 
 * @property int $codTipoEstilo
 * @property string $nomeTipoEstilo
 * 
 * @property Collection|Exame[] $exames
 *
 * @package App\Models
 */
class Tipoestilo extends Model
{
	protected $table = 'tipoestilo';
	protected $primaryKey = 'codTipoEstilo';
	public $timestamps = false;

	protected $fillable = [
		'nomeTipoEstilo'
	];

	public function exames()
	{
		return $this->hasMany(Exame::class, 'codTipoEstilo');
	}
}
