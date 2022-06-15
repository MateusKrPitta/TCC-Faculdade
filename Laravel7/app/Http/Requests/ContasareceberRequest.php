<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContasareceberRequest extends FormRequest {

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
            'cliente_id' => 'required|min:1|numeric',
            'valor' => 'required|min:0',
            'pagamento' => 'nullable|date|date_format:Y-m-d',
            'vencimento' => 'date|date_format:Y-m-d',
        ];
    }
    public function messages() {
        return [
            'valor.required' => 'Preencha o campo valor',
            'valor.min' => 'O valor mínimo é 1',
            'pagamento.date' => 'Preencha a Data de Pagamento',
            'pagamento.date_format' => 'O formato da Data de Pagamento está errado',
            'vencimento.date' => 'Preencha a Data de Vencimento.',
            'vencimento.date_format' => 'O formato da Data de Vencimento está errado.',
            
            
        ];
    }

}
