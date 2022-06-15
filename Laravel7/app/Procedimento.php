<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedimento extends Model
{
    protected $connection = 'basesistema';
    protected $table = 'procedimentos'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('empresa_id', 'especialidade_id', 'nome', 'tempo', 'valor', 'usuario_id'); //Informações que serão gravadas no banco
    
   

}
