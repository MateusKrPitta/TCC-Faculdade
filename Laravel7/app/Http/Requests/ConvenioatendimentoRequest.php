<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConvenioatendimentoRequest extends FormRequest {

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
            
            'numeronocartao' => 'required',
            'credenciado_id' => 'required|min:1',
            'tipodeatendimento' => 'required',
            'data' => 'required',
            'valor' => 'required|min:0|max:256000',
            'nomedoresponsavel' => 'required|min:2|max:256',
        ];
    }

    public function messages() {
        return [
            'numeronocartao.required' => 'É necessário preencher o número do cartão.',
            'credenciado_id.required' => 'É necessário selecionar o Credenciado. Se não existir nenhum, é necessário cadastrar.',
            'credenciado_id.min' => 'É necessário selecionar o Credenciado. Se não existir nenhum, é necessário cadastrar.',
            'nomedoresponsavel.required' => 'É necessário preencher o nome do responsavel.',
            'nome.min' => 'O Nome deve ter no mínimo 2 caracteres.',
            'nome.max' => 'O Nome deve ter no máximo 256 caracteres.',
            'data.required' => 'É necessário preencher a data.',
            'valor.required' => 'É necessário preencher o valor.',
            'tipodeatendimento.required' => 'É necessário selecionar o tipo de Atendimento. Se não existir nenhum, é necessário cadastrar.',
        ];
    }

}
