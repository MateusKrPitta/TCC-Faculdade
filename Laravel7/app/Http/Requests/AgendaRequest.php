<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AgendaRequest extends FormRequest {

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
            'nome' => 'required|min:2|max:256',
            'evento' => 'required|min:5|max:256',
            'data' => 'required|date|date_format:Y-m-d',
            'hora' => 'required',
            'observacao' => 'max:256',
        ];
    }

    public function messages() {
        return [
            'nome.required' => 'É necessário preencher o nome.',
            'nome.min' => 'O nome precisa ter no mínimo 2 letras',
            'nome.max' => 'O nome não pode exeder 256 caracteres',
            'evento.required' => 'É necessário preencher o evento.',
            'evento.min' => 'O evento precisa ter no mínimo 5 letras',
            'evento.max' => 'O evento não pode exeder 256 caracteres',
            'data.required' => 'A data deve ser preenchida',
            'data.date' => 'A valor informado deve ser do tipo data',
            'hora.required' => 'O horário deve ser preenchido',
            'observacao.max' => 'O número de caracteres deve ser inferior a 256',
        ];
    }

}
