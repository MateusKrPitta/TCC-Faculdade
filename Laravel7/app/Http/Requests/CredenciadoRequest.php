<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CredenciadoRequest extends FormRequest {

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
            'nome' => ['required', Rule::unique('credenciados')->ignore($this->id), 'min:2', 'max:256'],
            'cpfcnpj' => ['numeric', 'required', Rule::unique('credenciados')->ignore($this->id), 'cpf_cnpj'],
            'rgie' => ['nullable', Rule::unique('credenciados')->ignore($this->id)],
            'nascimento' => 'date|date_format:Y-m-d|after:1900-01-01|before:today',
            'sexo' => 'required',
            'tel1' => 'required|min:8',
            'numero' => 'nullable|numeric|min:1|max:99999',
            'estado' => 'nullable|min:2|max:2',
        ];
    }

    public function messages() {
        return [
            'nome.required' => 'É necessário preencher o nome.',
            'nome.unique' => 'Nome já está em uso.',
            'nome.min' => 'O Nome deve ter no mínimo 2 caracteres.',
            'nome.max' => 'O Nome deve ter no máximo 256 caracteres.',
            'cpfcnpj.required' => 'É necessário preencher o CPF.',
            'cpfcnpj.unique' => 'CPF já está em uso.',
            'cpfcnpj.numeric' => 'Digite apenas números no CPF.',
            'cpfcnpj.cpf_cnpj' => 'O número digitado para o CPF não é Válido.',
            'rgie.unique' => 'RG já está em uso.',
            'nascimento.date' => 'Digite a data de nascimento.',
            'nascimento.date_format' => 'O formato da data de nascimento está errado.',
            'nascimento.after' => 'A data de nascimento precisa ser posterior a 01/01/1900',
            'nascimento.before' => 'A data de nascimento não pode ser uma data futura. Coloque uma data entre 01/01/1900 e ontem.',
            'tel1.required' => 'É necessário preencher o número de telefone.',
            'tel1.min' => 'O número de telefone está incompleto.',
            'numero.numeric' => 'Digite apenas números no campo número do endereço',
            'numero.min' => 'O número do endereço deve ser no mínimo 0.',
            'numero.max' => 'O número do endereço deve ser no máximo 99999.',
            'estado.min' => 'A sigla do Estado é formada por duas letras, está faltando uma letra',
            'estado.max' => 'A sigla do Estado é formada por duas letras, verifique!',
        ];
    }

}
