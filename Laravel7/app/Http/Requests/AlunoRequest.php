<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlunoRequest extends FormRequest
{

    public function authorize()
    {
        //return false;
        return true;
    }

    public function rules()
    {
        return [
            //
            'nome' => ['required', Rule::unique('alunos')->ignore($this->id), 'min:2', 'max:256'],
            'nomepai' => ['nullable', 'min:2', 'max:256'],
            'nomemae' => ['required', 'min:2', 'max:256'],
            'nomeresponsavel' => ['nullable', 'min:2', 'max:256'],
            'nascimento' => 'required|date|date_format:Y-m-d',
            'nascimentopai' => 'nullable|date|date_format:Y-m-d',
            'nascimentomae' => 'required|date|date_format:Y-m-d',
            'nascimentoresponsavel' => 'nullable|date|date_format:Y-m-d',           
            /* 'data' => 'required|unique:posts|date|date_format:Y-m-d|before:' . $after_date . '|after:' . $before_date, */
            'sexo' => 'required',
            'cpf' => ['nullable', 'numeric', 'cpf_cnpj'],
            'cpfpai' => ['nullable', 'numeric', 'cpf_cnpj'],
            'cpfmae' => ['numeric', 'cpf_cnpj'],
            'cpfresponsavel' => ['nullable', 'cpf'],
            'numerotelefonepai' => 'nullable|min:8',
            'numerotelefonemae' => 'required|min:8',
            'numerotelefoneresponsavel' => 'nullable|min:8',
            'enderecopai' => 'nullable',
            'enderecomae' => 'required',
            'enderecoresponsavel' => 'nullable',       
            'bairroresponsavel' => 'nullable',
            'bairromae' => 'required',
            'bairropai' => 'nullable',
            'cidademae' => 'required',
            'cidadepai' => 'nullable',
            'cidaderesponsavel' => 'nullable',
            'estadomae' => 'required',
            'estadopai' => 'nullable',
            'estadoresponsavel' => 'nullable',
            'emailpai' => 'email|nullable',
            'emailmae' => 'email|nullable',
            'emailresponsavel' => 'email|nullable',
        ];
    }
    public function messages() {
        return [
            'nome.required' => 'É necessário preencher o nome.',
            'nome.unique' => 'Nome já está em uso.',
            'nome.min' => 'O Nome deve ter no mínimo 2 caracteres.',
            'nome.max' => 'O Nome deve ter no máximo 256 caracteres.',
            'cpf.required' => 'O CPF do aluno é obrigatório.',
            'cpf.unique' => 'CPF já está em uso.',
            'cpf.cpf_cnpj' => 'O número digitado para o CPF não é Válido.',
            'cpf.numeric' => 'Digite apenas números no CPF do aluno.',
            'cpfpai.required' => 'O CPF do pai é obrigatório.',
            'cpfpai.unique' => 'CPF já está em uso.',
            'cpfpai.cpf_cnpj' => 'O número digitado para o CPF não é Válido.',
            'cpfpai.numeric' => 'Digite apenas números no CPF do pai.',
            'cpfmae.required' => 'O CPF da mãe é obrigatório.',
            'cpfmae.unique' => 'CPF já está em uso.',
            'cpfmae.cpf_cnpj' => 'O número digitado para o CPF não é Válido.',
            'cpfmae.numeric' => 'Digite apenas números no CPF do aluno.',
            'cpfresponsavel.required' => 'O CPF da mãe é obrigatório.',
            'cpfresponsavel.unique' => 'CPF já está em uso.',
            'cpfresponsavel.cpf_cnpj' => 'O número digitado para o CPF não é Válido.',
            'cpfresponsavel.numeric' => 'Digite apenas números no CPF do aluno.',
            'nascimento.required' => 'É necessário preencher a data de nascimento do aluno.',
            
            'nomepai.required' => 'É necessário preencher o nome do Pai.',
            'nomepai.unique' => 'Nome do Pai já está em uso.',
            'nomepai.min' => 'O Nome do Pai deve ter no mínimo 2 caracteres.',
            'nomepai.max' => 'O Nome do Pai deve ter no máximo 256 caracteres.',
            'numerotelefonepai.required' => 'É necessário preencher o número de telefone do Pai.',
            'numerotelefonepai.min' => 'O número de telefone está incompleto do Pai.',
            'nascimentopai.required' => 'É necessário preencher a data de nascimento do Pai.',
            'enderecopai.required' => 'É necesário preencher o endereço do Pai.',
            'bairropai.required' => 'É necessário preencher o bairro do Pai.',
            'cidadepai.required' => 'É necessário preencher a cidade do Pai.',
            'estadopai.required' => 'É necessário preencher a estado do Pai.',
            'emailpai.email'  => 'É necessário preencher o email do Pai no formato certo.',
            
            'nomemae.required' => 'É necessário preencher o nome da Mãe.',
            'nomemae.unique' => 'Nome da Mãe já está em uso.',
            'nomemae.min' => 'O Nome da Mãe deve ter no mínimo 2 caracteres.',
            'nomemae.max' => 'O Nome da Mãe deve ter no máximo 256 caracteres.',
            'numerotelefonemae.required' => 'É necessário preencher o número de telefone da Mãe.',
            'numerotelefonemae.min' => 'O número de telefone da Mãe está incompleto.',
            'nascimentomae.required' => 'É necessário preencher a data de nascimento da Mãe.',
            'enderecomae.required' => 'É necesário preencher o endereço da Mãe.',
            'bairromae.required' => 'É necessário preencher o bairro da Mãe.',
            'cidademae.required' => 'É necessário preencher a cidade da Mãe.',
            'estadomae.required' => 'É necessário preencher a estado da Mãe.',
            'emailmae.email'  => 'É necessário preencher o email no formato certo da Mãe.',
            
            'nomeresponsavel.required' => 'É necessário preencher o nome do Responsável.',
            'nomeresponsavel.unique' => 'Nome do Responsável já está em uso.',
            'nomeresponsavel.min' => 'O Nome do Responsável deve ter no mínimo 2 caracteres.',
            'nomeresponsavel.max' => 'O Nome do Responsável deve ter no máximo 256 caracteres.',
            'numerotelefoneresponsavel.required' => 'É necessário preencher o número de telefone do Responsável.',
            'numerotelefoneresponsavel.min' => 'O número de telefone está incompleto do Responsável.',
            'nascimentoresponsavel.required' => 'É necessário preencher a data de nascimento do Responsável.',
            'enderecoresponsavel.required' => 'É necesário preencher o endereço do Responsável.',
            'bairroresponsavel.required' => 'É necessário preencher o bairro do Responsável.',
            'cidaderesponsavel.required' => 'É necessário preencher a cidade do Responsável.',
            'estadoresponsavel.required' => 'É necessário preencher a estado do Responsável.',
            'emailresponsavel.email'  => 'É necessário preencher o email do Responsável no formato certo.',
             
            ];
    }
}
