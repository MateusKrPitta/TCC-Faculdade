<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//use Illuminate\Support\Carbon;

class AnimalRequest extends FormRequest {

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
        //$before_date = Carbon::now()->subDays(15)->toDateString();
        //$after_date = Carbon::now()->addDays(15)->toDateString();

        return [
            'nome' => 'required|min:2|max:256',
            'numero' => 'required|min:1|numeric',
            'nascimento' => 'required|date|date_format:Y-m-d',
            'peso' => 'required|min:1|max:999|numeric',
            'sexo' => 'required',
        ];
    }

    public function messages() {
        return [
            'nome.required' => 'É necessário preencher o nome.',
            'nome.unique' => 'Nome já está em uso.',
            'nome.min' => 'O Nome deve ter no mínimo 2 caracteres.',
            'nome.max' => 'O Nome deve ter no máximo 256 caracteres.',
            'numero.required' => 'É necessário preencher o Número.',
            'numero.min' => 'O Número mínimo é 1.',
            'numero.numeric' => 'Digite apenas números.',
            'nascimento.date' => 'Digite a data de nascimento.',
            'nascimento.date_format' => 'O formato da data de nascimento está errado.',
            'nascimento.after' => 'A data de nascimento precisa ser posterior a 01/01/1900',
            'nascimento.before' => 'A data de nascimento não pode ser uma data futura. Coloque uma data entre 01/01/1900 e ontem.',
            'peso.numeric' => 'Digite apenas números no campo peso',
            'peso.min' => 'O peso deve ser no mínimo 0.',
            'peso.max' => 'O peso deve ser no máximo 99999.',
        ];
    }

}
