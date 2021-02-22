<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NovaContaRequest extends FormRequest
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
          'cpf'            => 'required|min:11|max:11',
          'nome'           => 'required|max:75',
          'email'          => 'required|max:85',
          'celular'        => 'required|min:11|max:11',
          'senha'          => 'required|max:150',
          'dataNascimento' => 'required|min:10|max:10',
          'cep'            => 'required|min:8|max:8',
          'estado'         => 'required',
          'cidade'         => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'dataNascimento' => 'data de nascimento',
        ];
    }
}
