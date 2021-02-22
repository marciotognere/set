<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrupoEstudoRequest extends FormRequest
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
         'nome'       => 'required|max:85',
         'descricao'  => '',
         'vagas'      => 'required|numeric',
         'disciplina' => 'required|numeric'
       ];
     }

     public function attributes()
     {
         return [
             'descricao' => 'descrição',
             'vagas'     => 'número de vagas'
         ];
     }
}
