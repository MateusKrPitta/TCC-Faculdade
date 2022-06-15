<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convenioconsultacartao extends Model {

    protected $connection = 'basesistema';
    protected $table = 'convenioconsultacartaos'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('empresa_id', 'conveniado_id', 'credenciado_id', 'numero', 'usuario_id'); //Informações que serão gravadas no banco

}
