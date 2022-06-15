<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
         //return false;
		return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|min:2|max:256',
            'codbarras' => 'min:0',
            'valor' => 'required|numeric',
	    'quantidade' => 'required|numeric',
        ];
    }
    public function messages() {
        return [
            'nome.required' => 'É necessário preencher o nome.',
            'nome.min' => 'O Nome deve ter no mínimo 2 caracteres.',
            'codbarras.min' => 'Infome a código de barras.',
            'valor.required' => 'Informe o valor.',
            'valor.numeric' => 'O campo valor deve ser numerico.',
            'quantidade.required' => 'Informe a quantidade.',
            'quantidade.numeric' => 'O campo quantidade deve ser numérico.',            
        ];
    }
}
