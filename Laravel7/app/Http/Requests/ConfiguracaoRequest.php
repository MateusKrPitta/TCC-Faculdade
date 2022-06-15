<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfiguracaoRequest extends FormRequest
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
			'diasdegestacao' => 'required|min:1|numeric',
			'mesesparaprimeirainseminacao' => 'required|min:1|numeric',
			'pesominimoparainseminacao' => 'required|min:1|numeric',
			'diasparainseminacao' => 'required|min:1|numeric',
			'diasparaconfirmacaodeinseminacao' => 'required|min:1|numeric',
			'diasparasecaravacaantesdoparto' => 'required|min:1|numeric'
        ];
    }
}
