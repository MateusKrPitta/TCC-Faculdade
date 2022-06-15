<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PassagemRequest extends FormRequest {

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
            'cliente_id' => 'required'
            //'razaosocial' => 'min:0',
            //'cpfcnpj' => 'required|min:1|max:999999999999999|numeric',
            //'rgie' => 'required|unique:clientes,rgie|min:1|max:99999999999999999|numeric',
            //'nascimento' => 'required|date|date_format:Y-m-d',
                /* 'data' => 'required|unique:posts|date|date_format:Y-m-d|before:' . $after_date . '|after:' . $before_date, */
                //'peso' => 'required|min:1|max:99999|numeric'
        ];
    }

}
