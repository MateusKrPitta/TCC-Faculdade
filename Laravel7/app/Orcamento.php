<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model {

    protected $connection = 'basesistema';
    protected $table = 'orcamentos'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('empresa_id', 'cliente_id', 'data', 'status', 'usuario_id'); //Informações que serão gravadas no banco

}
