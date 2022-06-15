<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VeiculoRequest extends FormRequest {

    public function authorize() {
        //return false;
        return true;
    }
    public function rules() {
        return [
            'nome' => 'nullable|min:5|max:256',
            'marcamodelo' => 'required|min:5|max:256',         
            'placa' => 'required|max:8|min:7',
            'acentos' => 'nullable|min:1|max:90|numeric',
            'cor_id' => 'required',
            'marca_id' => 'required',
            'especie_id' => 'required',
            'categoria_id' => 'required',
            'combustivel_id' => 'required',
            'carroceria_id' => 'required',
            'rodado_id' => 'required',
            'linha_id' => 'required',
            'propriedade_id' => 'required',
            'tipo_id' => 'required',
            'eixo_id' => 'required',
            //'renavam' => 'required',
            
        ];
    }
     public function messages() {
        return [
            'nome.required' => 'É necessário preencher o nome.',
            'nome.min' => 'O Nome deve conter no mínimo 3 caracteres.',
            'nome.max' => 'O Nome deve conterter no máximo 256 caracteres.',
            'marcamodelo.required' => 'Informe a Marca e o Modelo do Veículo.',
            'marcamodelo.min' => 'O Nome do Veiculo deve conter no mínimo 4 caracteres.',
            'marcamodelo.max' => 'O Nome do Veículo deve conter no máximo 256 caracteres.',
            'placa.required' => 'Informe a Placa do Veículo.',
            'placa.max' => 'A Placa do Veículo deve conter no máximo 8 caracteres.',
            'placa.min' => 'A Placa do Veículo deve conter no mínimo 7 caracteres.',
            'acentos.required' => 'Informe o número de acentos do veículo.',
            'acentos.min' => 'O Veículo deve conter no mínimo 1 acentos.',
            'acentos.max' => 'O Veículo deve conter no máximo 90 acentos.',
            'acentos.numeric' => 'Coloque apenas números no campo: Acentos do Veículo.',
            'cor_id.required' => 'Informe a cor do veículo.',
            'marca_id.required' => 'Informe a marca do veículo',
            'especie_id.required' => 'Informe a espécie do veículo.',
            'categoria_id.required' => 'Informe a categoria do veículo.',
            'combustivel_id.required' => 'Informe o combustível do veículo',
            'carroceria_id.required' => 'Informe o modelo de carroceria.',
            'rodado_id.required' => 'Informe o rodado do veículo.',
            'linha_id.required' => 'Informe a linha do veículo.',
            'propriedade_id.required' => 'Informe a propriedade do veículo.',
            'tipo_id.required' => 'Informe o tipo de veículo.',
            'eixo_id.required' => 'Informe o tipo de eixo.',
            'renavam.required' => 'Informe o renavam.',
            ];
    }

}
