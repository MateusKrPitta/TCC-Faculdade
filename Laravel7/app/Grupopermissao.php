<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupopermissao extends Model {

    protected $connection = 'basesistema';
    protected $table = 'grupopermissaos'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array( 'nome'); //Informações que serão gravadas no banco

}
