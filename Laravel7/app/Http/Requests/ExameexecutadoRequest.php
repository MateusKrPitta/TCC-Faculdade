<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExameexecutadoRequest extends FormRequest {


    public function authorize() {
        //return false;
        return true;
    }
    public function rules() {
        return [
            'resultado' => 'required|min:5|max:400',
            'hora' => 'required',         
            'data' => 'date|date_format:Y-m-d',
        ];
    }

    public function messages() {
        return [
            'resultado.required' => 'É necessário preencher o resultado.',
            'resultado.min' => 'O resultado precisa ter no mínimo 5 letras',
            'resultado.max' => 'O resultado não pode exeder 400 caracteres',
            'hora.required' => 'Informe o horário.',
            'data.date' => 'Preencha a Data do Exame.',
            'data.date_format' => 'O formato da Data do Exame está errado.',
        ];
    }

}
