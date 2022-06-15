<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//use Illuminate\Support\Carbon;

class VacinacaoRequest extends FormRequest {

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
            //'animal_id' => 'required',
            'vacina_id' => 'required|numeric',
            'datavacina' => 'required|date|date_format:Y-m-d',
            //'nascimento' => 'required|date|date_format:Y-m-d',
            /* 'data' => 'required|unique:posts|date|date_format:Y-m-d|before:' . $after_date . '|after:' . $before_date, */
            //'status' => 'required',
            'usuario_id' => 'required'
        ];
    }

}
