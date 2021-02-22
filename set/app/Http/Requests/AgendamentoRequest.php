<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendamentoRequest extends FormRequest
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
         'local'            => 'required',
         'grupoEstudo'      => 'required',
         'nomeAgendamento'  => 'required|max:80',
         'descrAgendamento' => '',
         'dataAgendamento'  => 'required|min:10|max:10',
         'horaAgendamento'  => 'required',
       ];
     }

     public function attributes()
     {
         return [
             'grupoEstudo'     => 'grupo de estudos',
             'dataAgendamento' => 'data do agendamento',
             'nomeAgendamento' => 'nome do agendamento',
             'horaAgendamento' => 'horário de agendamento'
         ];
     }
}
