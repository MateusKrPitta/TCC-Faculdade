<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CredenciadocategoriaRequest extends FormRequest {

    public function authorize() {
        //return false;
        return true;
    }

    public function rules() {
        return [
            'nome' => ['required', Rule::unique('clientes')->ignore($this->id), 'min:2', 'max:256'],
        ];
    }

    public function messages() {
        return [
            'nome.required' => 'É necessário preencher o nome.',
            'nome.unique' => 'Nome já está em uso.',
            'nome.min' => 'O Nome deve ter no mínimo 2 caracteres.',
            'nome.max' => 'O Nome deve ter no máximo 256 caracteres.',
        ];
    }

}
