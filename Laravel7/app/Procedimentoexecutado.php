<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedimentoexecutado extends Model {

    protected $connection = 'basesistema';
    protected $table = 'procedimentoexecutados'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('empresa_id', 'medico_id', 'cliente_id', 'procedimento_id', 'valor', 'data_da_execucao', 'status', 'usuario_id'); //Informações que serão gravadas no banco   

}
