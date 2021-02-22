<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatriculaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
        'instituicao'       => 'required',
        'curso'             => 'required',
        'dataInicioCurso'   => 'required|min:10|max:10',
        'dataFimCurso'      => 'required|min:10|max:10',
        'situacaoMatricula' => 'required',
      ];
    }

    public function attributes()
    {
        return [
            'instituicao'       => 'instituição',
            'dataInicioCurso'   => 'data de início do curso',
            'dataFimCurso'      => 'data de fim do curso',
            'situacaoMatricula' => 'situação',
        ];
    }
}
