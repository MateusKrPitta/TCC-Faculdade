<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exameexecutado extends Model
{
    protected $connection = 'basesistema';
    protected $table = 'exameexecutados'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('empresa_id', 'cliente_id', 'consulta_id', 'medico_id', 'exame_id', 'resultado', 'data', 'hora', 'status', 'usuario_id'); //Informações que serão gravadas no banco

     
}




