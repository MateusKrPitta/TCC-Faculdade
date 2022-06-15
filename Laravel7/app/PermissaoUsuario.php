<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissaoUsuario extends Model {

    protected $connection = 'basesistema';
    protected $table = 'permissao_usuario'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('usuario_id', 'permissao_id'); //Informações que serão gravadas no banco

    

}
