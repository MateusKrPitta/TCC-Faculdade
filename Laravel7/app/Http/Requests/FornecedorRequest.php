<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FornecedorRequest extends FormRequest {

    public function authorize() {
        //return false;
        return true;
    }

    public function rules() {
        return [
            'nome' => ['required', Rule::unique('fornecedores')->ignore($this->id), 'min:2', 'max:256'],
            'cpfcnpj' => ['numeric', 'required', Rule::unique('fornecedores')->ignore($this->id), 'cpf_cnpj'],
            'rgie' => ['nullable', Rule::unique('fornecedores')->ignore($this->id)],
            'razaosocial' => ['nullable', Rule::unique('fornecedores')->ignore($this->id)],
            'email' => 'nullable|email|max:255',
            'nascimento' => 'date|date_format:Y-m-d|after:1900-01-01|before:today',
            'tel1' => 'required|min:8',
            'tel2' => 'nullable|min:8',
            'logradouro' => 'nullable|min:5',
            'numero' => 'nullable|numeric|min:1|max:99999',
            'bairro' => 'nullable|min:2',
            'complemento' => 'nullable|min:2',
            'cidade' => 'nullable|min:2',
            'estado' => ['required', 'min:2', 'max:2'],
            'cep' => 'nullable|min:8',
            'contatonome' => 'nullable|min:2',
            'contatotelefone' => 'nullable|min:2',
            'contatoemail' => 'nullable|min:2',
            'observacao' => 'nullable|min:2',
        ];
    }
    public function messages() {
        return [
            'nome.required' => 'É necessário preencher o nome.',
            'nome.unique' => 'Nome já está em uso.',
            'nome.min' => 'O Nome deve ter no mínimo 2 caracteres.',
            'nome.max' => 'O Nome deve ter no máximo 256 caracteres.',
            //'cpfcnpj.required' => 'É necessário preencher o CPF.',
            'cpfcnpj.required' => 'É necessário preencher o CPF.',
            'cpfcnpj.unique' => 'CPF já está em uso.',
            'cpfcnpj.numeric' => 'Digite apenas números no CPF.',
            'cpfcnpj.cpf_cnpj' => 'O número digitado para o CPF não é Válido.',
            'rgie.unique' => 'RG já está em uso.',
            'razaosocial.unique' => 'Razão Social já está em uso.',
            'nascimento.date' => 'Digite a data de nascimento.',
            'nascimento.date_format' => 'O formato da data de nascimento está errado.',
            'nascimento.after' => 'A data de nascimento precisa ser posterior a 01/01/1900.',
            'nascimento.before' => 'A data de nascimento não pode ser uma data futura. Coloque uma data entre 01/01/1900 e ontem.',
            'estado.required' => 'Preencha o estado somente com a sigla.',
            'estado.min' => 'Informe a sigla do estado com 2 caracteres.',
            'estado.max' => 'Informe a sigla do estado com 2 caracteres.',
            'tel1.required' => 'É necessário preencher o número de telefone.',
            'tel1.min' => 'O número de telefone deve conter 8 dígitos.',
            'tel2.min' => 'O número de telefone deve conter 8 dígitos.',
            'logradouro.min' => 'O logradouro deve conter no mínimo 5 caracteres.',
            'numero.numeric' => 'Digite apenas números no campo número do endereço',
            'numero.min' => 'O número do endereço deve ser no mínimo 0.',
            'numero.max' => 'O número do endereço deve ser no máximo 99999.',
            'bairro.min' => 'O bairro deve conter no mínimo 2 caracteres.',
            'complemento.min' => 'O complemento deve conter no mínimo 2 caracteres.',
            'cidade.min' => 'A cidade deve conter no mínimo 2 caracteres.',
            'cep.min' => 'O cep deve conter no mínimo 8 caractere.s',
            'contatonome.min' => 'O Contato Nome deve conter no mínimo 2 caracteres.',
            'contatotelefone.min' => 'O Contato Telefone deve conter no mínimo 8 dígitos.',
            'contatoemail.min' => 'O Contato Email deve conter no mínimo 2 caracteres.',
            'observacao.min' => 'A observação deve conter no mínimo 2 caracteres.'
        ];
    }

}
