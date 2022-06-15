<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContratoconvenioRequest extends FormRequest {

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
            'conveniado_id' => 'required',
            'plano_id' => 'required',
            'formadepagamento_id' => 'required|min:1',
            'datadocontrato' => 'required|date|date_format:Y-m-d',
                /* 'data' => 'required|unique:posts|date|date_format:Y-m-d|before:' . $after_date . '|after:' . $before_date, */
                //'peso' => 'required|min:1|max:99999|numeric'
        ];
    }

    public function messages() {
        return [
            'conveniado_id.required' => 'Antes de fazer um contrato, é necessário cadastrar um Conveniado',
            'plano_id.required' => 'Antes de fazer um contrato, é necessário cadastrar um Plano',
            'formadepagamento_id.required' => 'Antes de fazer um contrato, é necessário cadastrar uma Forma de Pagamento',
            'valor.required' => 'É necessário preencher o Valor.',
            'valor.numeric' => 'O campo Valor deve ser numérico.',
            'datadocontrato.required' => 'É necessário preencher a data do contrato.',
            'datadocontrato.date' => 'O formato da data está incorreto.',
        ];
    }

}
