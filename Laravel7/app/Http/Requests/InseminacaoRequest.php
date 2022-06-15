<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InseminacaoRequest extends FormRequest
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
            //
			'animal_id' => 'required|min:1|numeric',
			'datainseminacao' => 'required|date|date_format:Y-m-d',
			'turno' => 'required',
			'touro' => 'required',
			'inseminador' => 'required'
        ];
    }

    public function messages() {
        return [
            'animal_id.required' => 'É necessário preencher o nome.',
            'datainseminacao.date' => 'Digite a data de nascimento.',
            'datainseminacao.date_format' => 'O formato da data de nascimento está errado.',
            'datainseminacao.after' => 'A data de nascimento precisa ser posterior a 01/01/1900',
            'datainseminacao.before' => 'A data de nascimento não pode ser uma data futura. Coloque uma data entre 01/01/1900 e ontem.',
            'turno.required' => 'É necessário selecionar o turno.',
            'touro.required' => 'É necessário preencher o nome do touro.',
            'inseminador.required' => 'É necessário preencher o nome do inseminador.',
        ];
    }
}
