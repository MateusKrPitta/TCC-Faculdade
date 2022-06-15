<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conveniado extends Model {

    protected $connection = 'basesistema';
    protected $table = 'conveniados'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('empresa_id', 'titular_id', 'nome', 'cpfcnpj', 'rgie', 'nascimento', 'sexo', 'estadocivil_id', 'parentesco_id', 'tel1', 'tel2', 'logradouro', 'numero', 'bairro', 'complemento', 'cidade', 'estado', 'cep', 'email', 'status', 'observacao', 'usuario_id', 'imagem'); //Informações que serão gravadas no banco

    public function filtro(Array $dados, $linhasNaPagina) {
        return $this->where(function ($query) use ($dados) {
                            if (isset($dados['nome']))
                                $query->where('nome', 'ilike', '%' . $dados['nome'] . '%');
                        })
                        ->orderBy('nome')->where('empresa_id', Usuario::empresa())->paginate($linhasNaPagina);
    }

    //Coloca todas as letras em maiusculas antes de gravar no banco de dados
    public function setNomeAttribute($value) {
        $this->attributes['nome'] = mb_strtoupper($value);
    }

}
