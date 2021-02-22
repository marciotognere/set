<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Local
 * 
 * @property int $codLocal
 * @property string $nomeLocal
 * 
 * @property Collection|Agendamento[] $agendamentos
 *
 * @package App\Models
 */
class Local extends Model
{
	protected $table = 'local';
	protected $primaryKey = 'codLocal';
	public $timestamps = false;

	protected $fillable = [
		'nomeLocal'
	];

	public function agendamentos()
	{
		return $this->hasMany(Agendamento::class, 'codLocal');
	}
}
