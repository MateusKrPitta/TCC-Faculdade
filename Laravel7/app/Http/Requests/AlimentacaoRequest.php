<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlimentacaoRequest extends FormRequest {

    public function authorize() {
        //return false;
        return true;
    }

    public function rules() {
        return [
            'animal_id' => 'required|min:1',
            'alimento_id' => 'required|min:1',
            'peso' => 'required|numeric',
            'dataalimentacao' => 'date|date_format:Y-m-d|after:2000-01-01',
        ];
    }
        public function messages() {
        return [
            'animal_id.required' => 'É necessário selecionar o animal.',
            'animal_id.min' => 'Nenhum animal selecionado.',      
            'alimento_id.required' => 'É necessário selecionar o alimento.',
            'peso.numeric' => 'É necessário preencher com numero o campo peso.',
            'alimento_id.min' => 'Nenhum alimento selecionado.',      
            'dataalimentacao.date' => 'Digite a data do inicio.',
            'dataalimentacao.date_format' => 'O formato da data de inicio está errado.',
            'dataalimentacao.after' => 'A data da alimentação precisa ser posterior a 01/01/1900',
            
        ];
    }

}
