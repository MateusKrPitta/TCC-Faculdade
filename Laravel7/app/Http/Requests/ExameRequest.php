<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExameRequest extends FormRequest {

    public function authorize() {
        //return false;
        return true;
    }

    public function rules() {
        return [
            'nome' => 'required|min:2|max:256',
            'valor' => 'required|numeric',
            'valor_referencia' => 'required|max:256',
            'tempo' => 'required|numeric',
        ];
    }

    public function messages() {
        return [
            'nome.required' => 'É necessário preencher o nome.',
            'nome.min' => 'O nome precisa ter no mínimo 2 letras.',
            'nome.max' => 'O nome não pode exeder 256 caracteres.',
            'valor.required' => 'Informe o valor.',
            'valor.numeric' => 'O campo valor deve ser numerico.',
            'valor_referencia.max' => 'O número de caracteres deve ser inferior a 256.',
            'valor_referencia.required' => 'Informe o valor de referencia.',
            'tempo.required' => 'Preencha Tempo do Exame.',
            'tempo.numeric' => 'Preencha em números o Tempo',
        ];
    }

}
