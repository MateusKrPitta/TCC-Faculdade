<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estadocivil extends Model
{
    protected $connection = 'basesistema';
    protected $table = 'estadocivils'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('empresa_id', 'nome', 'status', 'usuario_id'); //Informações que serão gravadas no banco

}