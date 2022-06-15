<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlanoRequest extends FormRequest {

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
            //'nome' => 'required|min:5',
            'nome' => ['required', Rule::unique('planos')->ignore($this->route('id')) ],
            'quantidadedependentes' => 'required',
            'tempodeduracao' => 'required',
            //'razaosocial' => 'min:0',
            //'cpfcnpj' => 'required|min:1|max:999999999999999|numeric',
            //'cpfcnpj' => ['required', Rule::unique('planos')->ignore($this->route('id')) ],
            //'rgie' => 'required|unique:planos,rgie|min:1|max:99999999999999999|numeric',
            //'nascimento' => 'date|date_format:Y-m-d',
            /* 'data' => 'required|unique:posts|date|date_format:Y-m-d|before:' . $after_date . '|after:' . $before_date, */
            //'peso' => 'required|min:1|max:99999|numeric'
        ];
    }
    public function messages() {
        return [
           'quantidadedependentes.required' => 'É necessário informar Dependentes.',
           'tempodeduracao.required' => 'É necessário informar os Meses de Duração.'
            
        ];
    }

}
