<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Questao
 * 
 * @property int $codQuestao
 * @property string $descrQuestao
 * @property string $imagemQuestao
 * @property int $codAtividade
 * 
 * @property Atividade $atividade
 * @property Collection|Alternativa[] $alternativas
 *
 * @package App\Models
 */
class Questao extends Model
{
	protected $table = 'questao';
	protected $primaryKey = 'codQuestao';
	public $timestamps = false;

	protected $casts = [
		'codAtividade' => 'int'
	];

	protected $fillable = [
		'descrQuestao',
		'imagemQuestao',
		'codAtividade'
	];

	public function atividade()
	{
		return $this->belongsTo(Atividade::class, 'codAtividade');
	}

	public function alternativas()
	{
		return $this->hasMany(Alternativa::class, 'codQuestao');
	}
}
