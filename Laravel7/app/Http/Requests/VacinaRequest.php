<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//use Illuminate\Support\Carbon;

class VacinaRequest extends FormRequest {

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
'nomevacina' => 'required|unique:vacinas,nomevacina|min:3|max:256',
 'sexoaplicacao' => 'required',
 'tipovacina' => 'required',
 //'nascimento' => 'required|date|date_format:Y-m-d',
/* 'data' => 'required|unique:posts|date|date_format:Y-m-d|before:' . $after_date . '|after:' . $before_date, */
//'status' => 'required',
'usuario_id' => 'required'
];
}
public function messages() {
return [
'nome.required' => 'É necessário preencher o nome.',
 'nome.min' => 'O nome precisa ter no mínimo 2 letras.',
 'nome.max' => 'O nome não pode exeder 256 caracteres.',
 'valor.required' => 'Informe o valor.',
 'valor.numeric' => 'O campo valor deve ser numerico.',
 'valor_referencia.max' => 'O número de caracteres deve ser inferior a 256.',
 'valor_referencia.required' => 'Informe o valor de referencia.',
 'tempo.required' => 'Preencha Tempo do Exame.',
 'tempo.numeric' => 'Preencha em números o Tempo',
];
}
}

