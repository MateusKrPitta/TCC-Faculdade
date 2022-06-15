<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContratoviagemRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        //return false;
        return true;
    }

    public function rules() {
        return [
            'cliente_id' => 'required',
            'localdedestino' => 'required',
            'itinerario' => 'required',
            'valor' => ['required', 'numeric'],
            'localembarqueinicio' => 'required',
            'datainicio' => ['required'],
            'horainicio' => ['required'],
            'localembarqueretorno' => 'required',
            'dataretorno' => ['required'],
            'horaretorno' => ['required'],
        ];
    }
     public function messages() {
        return [
            'localdedestino.required' => 'É necessário preencher o Local de Destino.',
            'itinerario.required' => 'É necessário preencher o Itinerário.',
            'valor.required' => 'É necessário preencher o Valor.',
            'valor.numeric' => 'O campo Valor deve ser numérico.',
            'localembarqueinicio.required' => 'É necessário preencher o Local de Embarque.',
            'datainicio.required' => 'É necessário preencher a Data de Ínicio da Viagem.',
            'horainicio.required' => 'É necessário preencher a Hora de Ínicio da Viagem.',
            'localembarqueretorno.required' => 'É necessário preencher o Local de Embarque do Retorno.',
            'dataretorno.required' => 'É necessário preencher a Data de Retorno da Viagem.',
            'horaretorno.required' => 'É necessário preencher a Hora de Retorno da Viagem.',
        ];
    }

}
