<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GestacaoRequest extends FormRequest {

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
            //
            'inseminacao_id' => 'required|min:1|numeric',
            'dataconfirmacao' => 'required|date|date_format:Y-m-d',
            /* 'data' => 'required|unique:posts|date|date_format:Y-m-d|before:' . $after_date . '|after:' . $before_date, */
            'examinador' => 'required',
            //'usuario_id' => 'required'
        ];
    }

}
