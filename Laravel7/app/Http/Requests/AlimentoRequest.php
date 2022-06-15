<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlimentoRequest extends FormRequest {

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
            'nome' => 'required|unique:alimentos,nome|min:5|max:256',
            'composicao' => 'required|min:5',
            'peso' => 'required|min:0|numeric',
            'valor' => 'required|min:0',
            'inicio' => 'required|date',
            'fim' => 'date',
        ];
    }

}
