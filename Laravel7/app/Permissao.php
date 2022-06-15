<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model {

    protected $connection = 'basesistema';
    protected $table = 'permissaos'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('nome', 'descricao', 'grupo', 'usuario_id'); //Informações que serão gravadas no banco

    public function filtro(Array $dados, $linhasNaPagina) {
        return $this->where(function ($query) use ($dados) {
            if (isset($dados['grupo']))
                $query->where('grupo', 'ilike', '%' . $dados['grupo'] . '%');
        })
        ->orderBy('nome')->where('usuario_id', 0)->paginate($linhasNaPagina);
    }

}
