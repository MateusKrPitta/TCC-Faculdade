<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProducaoRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        //return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [

            'data_producao' => 'required|date|date_format:Y-m-d',
            /* 'data' => 'required|unique:posts|date|date_format:Y-m-d|before:' . $after_date . '|after:' . $before_date, */
            'hora_producao' => 'required',
            'quantidade' => 'required|numeric',
        ];
    }

    public function messages() {
        return [
            
            'data.date' => 'A valor informado deve ser do tipo data',
            'horario_consulta.required' => 'O horário deve ser preenchido',
        ];
    }

}
