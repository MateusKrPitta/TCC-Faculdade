<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConsultaRequest extends FormRequest {

    public function authorize() {
        //return false;
        return true;
    }

    public function rules() {
        return [           
            'data' => 'required|date|date_format:Y-m-d',
            'horario_consulta' => 'required',
            'medico_id' => 'required',
        ];
    }

    public function messages() {
        return [
            'data.required' => 'A data deve ser preenchida',
            'data.date' => 'A valor informado deve ser do tipo data',
            'horario_consulta.required' => 'O horário deve ser preenchido',
            'medico_id.required' => 'Cadastre um médico.',
        ];
    }

}