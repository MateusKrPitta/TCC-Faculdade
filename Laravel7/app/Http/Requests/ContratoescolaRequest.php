<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContratoescolaRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        //return false;
        return true;
    }

    public function rules() {
        return [
            'aluno_id' => 'required',
            'cliente_id' => 'required',
            'valor' => ['required'],
            'formadepagamento_id' => ['required'],
            'datadocontrato' => ['required', 'date'],
        ];
    }

    public function messages() {
        return [
            'aluno_id.required' => 'Antes de fazer um contrato, é necessário cadastrar um Aluno',
            'cliente_id.required' => 'Antes de fazer um contrato, é necessário cadastrar um Cliente',
            'valor.required' => 'É necessário preencher o Valor.',
            'valor.numeric' => 'O campo Valor deve ser numérico.',
            'formadepagamento_id.required' => 'Antes de fazer um contrato, é necessário cadastrar uma Forma de Pagamento',
            'datadocontrato.required' => 'É necessário preencher a data do contrato.',
            'datadocontrato.date' => 'O formato da data está incorreto.',
        ];
    }

}
