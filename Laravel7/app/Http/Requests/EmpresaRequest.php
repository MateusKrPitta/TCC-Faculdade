<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest {

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
			'nome' => 'required|unique:empresas,nome|min:5|max:256',
			'razaosocial' => 'min:0',
			'cpfcnpj' => 'required|unique:empresas,cpfcnpj|min:1|max:9999999999999999|numeric',
			'rgie' => 'required|min:1|max:99999999999999999',
			'observacao' => 'min:0',
		];
	}

}
