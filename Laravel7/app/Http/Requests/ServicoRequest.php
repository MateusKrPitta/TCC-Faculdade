<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicoRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required',
            'tempo' => ['required', 'numeric'],
            'valor' => ['required', 'numeric'],
        ];
    }
     public function messages() {
        return [
            'nome.required' => 'É necessário prencher o Nome do Serviço.',
            'tempo.required' => 'É necessário preencher o Tempo do Serviço.',
            'tempo.numeric' => 'O campo Tempo deve ser numérico.',
            'valor.required' => 'É necessário preencher o Valor.',
            'valor.numeric' => 'O campo Valor deve ser numérico.',
        ];
    }
}
