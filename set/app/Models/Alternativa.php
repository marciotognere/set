<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Alternativa
 * 
 * @property int $codAlternativa
 * @property string $letraAlternativa
 * @property string $descrAlternativa
 * @property string $certaAlternativa
 * @property int $codQuestao
 * 
 * @property Questao $questao
 * @property Collection|Respostaavaliacao[] $respostaavaliacaos
 *
 * @package App\Models
 */
class Alternativa extends Model
{
	protected $table = 'alternativa';
	protected $primaryKey = 'codAlternativa';
	public $timestamps = false;

	protected $casts = [
		'codQuestao' => 'int'
	];

	protected $fillable = [
		'letraAlternativa',
		'descrAlternativa',
		'certaAlternativa',
		'codQuestao'
	];

	public function questao()
	{
		return $this->belongsTo(Questao::class, 'codQuestao');
	}

	public function respostaavaliacaos()
	{
		return $this->hasMany(Respostaavaliacao::class, 'codAlternativa');
	}
}
