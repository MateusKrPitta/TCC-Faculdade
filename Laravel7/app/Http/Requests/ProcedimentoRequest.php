<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProcedimentoRequest extends FormRequest {

    public function authorize() {
        //return false;
        return true;
    }

    public function rules() {
        return [
            'nome' => 'required|min:5|max:20',
            'especialidade_id' => 'required',
            'tempo' => 'required|numeric',
            'valor' => 'required|numeric',
            ];
    }

    public function messages() {
        return [
            'nome.required' => 'É necessário preencher o nome.',
            'nome.min' => 'O Nome deve ter no mínimo 2 caracteres.',
            'nome.max' => 'O Nome deve ter no máximo 256 caracteres.',
            'tempo.required' => 'A Tempo deve ser preenchido',
            'tempo.date' => 'O Tempo deve ser em horas ',
            'valor.required' => 'Informe o Valor do Procedimento.',
            'valor.numeric' => 'O campo Valor deve ser numerico.',

        ];
    }

}
