<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Agendamento
 *
 * @property int $codAgendamento
 * @property int $codLocal
 * @property int $codGrupoEstudo
 * @property string $nomeAgendamento
 * @property string $descrAgendamento
 * @property Carbon $dataAgendamento
 * @property string $horaAgendamento
 * @property string $monitorAgendamento
 *
 * @property Grupoestudo $grupoestudo
 * @property Local $local
 *
 * @package App\Models
 */
class Agendamento extends Model
{
	protected $table = 'agendamento';
	protected $primaryKey = 'codAgendamento';
	public $timestamps = false;

	protected $casts = [
		'codLocal' => 'int',
		'codGrupoEstudo' => 'int'
	];

	protected $dates = [
		'dataAgendamento'
	];

	protected $fillable = [
		'codLocal',
		'codGrupoEstudo',
		'nomeAgendamento',
		'descrAgendamento',
		'dataAgendamento',
		'horaAgendamento',
		'monitorAgendamento'
	];

	public function grupoestudo()
	{
		return $this->belongsTo(Grupoestudo::class, 'codGrupoEstudo');
	}

	public function local()
	{
		return $this->belongsTo(Local::class, 'codLocal');
	}
}
