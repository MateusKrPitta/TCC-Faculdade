<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model {

    protected $connection = 'basesistema';
    protected $table = 'animals'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('empresa_id', 'nome', 'numero', 'nascimento', 'pai', 'mae', 'sexo', 'status', 'peso', 'usuario_id'); //Informações que serão gravadas no banco
    public function filtro(Array $dados, $linhasNaPagina) {
        return $this->where(function ($query) use ($dados) {
                            if (isset($dados['nome']))
                                $query->where('nome', 'ilike', '%' . $dados['nome'] . '%');

                        })
                        ->orderBy('nome')->where('empresa_id', Usuario::empresa())->paginate($linhasNaPagina);
    }
}
