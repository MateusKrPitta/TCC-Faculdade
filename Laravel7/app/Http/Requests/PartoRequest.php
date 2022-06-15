<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartoRequest extends FormRequest {

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
            //
            'gestacao_id' => 'required|min:1|numeric',
            'dataparto' => 'required|date|date_format:Y-m-d',
            'acompanhante' => 'required',
            'status_parto' => 'required',
        ];
    }

    public function messages() {
        return [
            'gestacao_id.required' => 'É necessário Selecionar um Animal.',
            'dataparto.date' => 'Digite a data do parto.',
            'dataparto.date_format' => 'O formato da data do parto está errado.',
            'dataparto.after' => 'A data do parto precisa ser posterior a 01/01/1900',
            'dataparto.before' => 'A data do parto não pode ser uma data futura. Coloque uma data entre 01/01/1900 e ontem.',
            'acompanhante.required' => 'É necessário preencher o nome do acompanhante do parto.',
            'status_parto.required' => 'É necessário Selecionar a situação do filhote.',
            'usuario_id.required' => 'É necessário inserir o Usuário.',
        ];
    }

}
