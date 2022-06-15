<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ViagemRequest extends FormRequest {

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
            'nome' => 'required|min:2|max:256',
            'origem' => 'required|min:2|max:256',
            'destino' => 'required|min:2|max:256',
            'data' => 'required|date|date_format:Y-m-d',
            'hora' => 'required',
             //'razaosocial' => 'min:0',
            //'cpfcnpj' => 'required|min:1|max:999999999999999|numeric',
            //'rgie' => 'required|unique:clientes,rgie|min:1|max:99999999999999999|numeric',
            //'nascimento' => 'required|date|date_format:Y-m-d',
                /* 'data' => 'required|unique:posts|date|date_format:Y-m-d|before:' . $after_date . '|after:' . $before_date, */
                //'peso' => 'required|min:1|max:99999|numeric'
        ];
    }
    public function messages() {
        return [
            'nome.required' => 'É necessário preencher o nome.',
            'nome.min' => 'O Nome deve ter no mínimo 2 caracteres.',
            'nome.max' => 'O Nome deve ter no máximo 256 caracteres.',
            'origem.required' => 'É necessário preencher a origem.',
            'origem.min' => 'A Origem deve ter no mínimo 2 caracteres.',
            'origem.max' => 'A Origem deve ter no máximo 256 caracteres.',
            'destino.required' => 'É necessário preencher o destino.',
            'destino.min' => 'O Destino deve ter no mínimo 2 caracteres.',
            'destino.max' => 'O Destino deve ter no máximo 256 caracteres.',
            'data.required' => 'A data deve ser preenchida',
            'data.date' => 'A valor informado deve ser do tipo data',
            'hora.required' => 'A hora deve ser preenchida',
            ];
    }

}
