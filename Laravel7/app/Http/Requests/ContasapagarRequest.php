<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContasapagarRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        //return false;
        return true;;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'fornecedor_id' => 'required|min:1|numeric',
            'descricao' => 'min:3|max:256',
            'valor' => 'required|min:0',
            'vencimento' => 'date|date_format:Y-m-d',
            'pagamento' => 'nullable|date|date_format:Y-m-d',
            'usuario_id' => 'required'
        ];
    }
   
    public function messages() {
        return [
            'pagamento.date' => 'Preencha a Data de Pagamento',
            'pagamento.date_format' => 'O formato da Data de Pagamento está errado',
            'vencimento.date' => 'Preencha a Data de Vencimento.',
            'vencimento.date_format' => 'O formato da Data de Vencimento está errado.',
            
            
        ];
    }

}
