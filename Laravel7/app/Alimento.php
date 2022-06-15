<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alimento extends Model {

    //
    protected $table = 'alimentos'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('nome', 'composicao', 'peso', 'valor', 'inicio', 'fim', 'status', 'usuario_id', 'empresa_id'); //Informações que serão gravadas no banco

    public function filtro(Array $dados, $linhasNaPagina) {
        return $this->where(function ($query) use ($dados) {
                            if (isset($dados['nome']))
                                $query->where('nome', 'ilike', '%' . $dados['nome'] . '%');
                        })
                        ->orderBy('nome')->where('empresa_id', Usuario::empresa())->paginate($linhasNaPagina);
    }

}
