<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Disciplina
 *
 * @property int $codDisciplina
 * @property string $nomeDisciplina
 * @property int $cargaHorariaDisciplina
 *
 * @property Collection|Grade[] $grades
 * @property Collection|Grupoestudo[] $grupoestudos
 * @property Collection|Monitor[] $monitores
 *
 * @package App\Models
 */
class Disciplina extends Model
{
	protected $table = 'disciplina';
	protected $primaryKey = 'codDisciplina';
	public $timestamps = false;

	protected $casts = [
		'cargaHorariaDisciplina' => 'int'
	];

	protected $fillable = [
		'nomeDisciplina',
		'cargaHorariaDisciplina'
	];

	public function grades()
	{
		return $this->hasMany(Grade::class, 'codDisciplina');
	}

	public function grupoestudos()
	{
		return $this->hasMany(Grupoestudo::class, 'codDisciplina');
	}

	public function monitores()
	{
		return $this->hasMany(Monitor::class, 'codDisciplina');
	}
}
