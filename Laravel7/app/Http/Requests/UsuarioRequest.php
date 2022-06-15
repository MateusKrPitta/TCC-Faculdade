<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest {

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
            'name' => 'required|required|min:5|max:256',
            'empresa_id' => 'required|min:1',
            'usuario_id' => 'required|min:1',
            'email' => 'required|min:0',
            'password' => 'required|min:1',
            'perfil_id' => 'required|min:1',
            'status' => 'required|min:1'
            //'cpfcnpj' => 'required|min:1|max:999999999999999|numeric',
            //'rgie' => 'required|unique:clientes,rgie|min:1|max:99999999999999999|numeric',
            //'nascimento' => 'required|date|date_format:Y-m-d',
            /* 'data' => 'required|unique:posts|date|date_format:Y-m-d|before:' . $after_date . '|after:' . $before_date, */
            //'peso' => 'required|min:1|max:99999|numeric'
        ];
    }

}
