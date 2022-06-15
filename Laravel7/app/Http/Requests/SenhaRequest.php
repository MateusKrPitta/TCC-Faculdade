<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SenhaRequest extends FormRequest {

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
            'password' => 'required|min:1',
            'password1' => 'required|confirmed|min:1',
            'password2' => 'required|min:1',
            'password1' => 'required_with:password2|same:password1|min:1',
        ];
    }

    public function messages() {
        return [
            'password.required' => 'A senha atual não foi digitada.',
            'password.min' => 'A senha atual deve conter no mínimo 1 caracteres.',
            'password1.required' => 'A nova senha não foi digitada.',
            'password1.min' => 'A nova senha deve conter no mínimo 1 caracteres.',
            'password2.required' => 'A confirmação da nova senha não foi digitada.',
            'password2.min' => 'A confirmação da nova senha deve conter no mínimo 1 caracteres.',
            
        ];
    }

}
