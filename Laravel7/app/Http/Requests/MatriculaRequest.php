<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatriculaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'aluno_id' => 'required',
            'valor_mensalidade' => 'required|numeric',
            'valor_mensalidade' => 'required|numeric',
           'valor_matricula'  => 'required|numeric',

        ];
    }
        public function messages() {
        return [
            
            'valor_matricula.numeric' => 'O campo valor da matricula deve ser numerico',
            'valor_matricula.required' => 'Informe o valor',
            'valor_mensalidade.required' => 'Informe o valor',
            'valor_mensalidade.numeric' => 'O campo valor da mensalidade deve ser numerico',
        ];
    }
}
