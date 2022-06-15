<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProcedimentoexecutadoRequest extends FormRequest {

    public function authorize() {
        //return false;
        return true;
    }

    public function rules() {
        return [
            'procedimento_id' => 'required',
            'medico_id' => 'required',
            'cliente_id' => 'required',
            'data_da_execucao' => 'required|date|date_format:Y-m-d',
            'valor' => 'required|numeric',
            ];
    }

    public function messages() {
        return [
            'data_da_execucao.required' => 'A data deve ser preenchida',
            'data_da_execucao.date' => 'A valor informado deve ser do tipo data',
            'valor.required' => 'Informe o Valor do Procedimento.',
            'valor.numeric' => 'O campo Valor deve ser numerico.',

        ];
    }

}
