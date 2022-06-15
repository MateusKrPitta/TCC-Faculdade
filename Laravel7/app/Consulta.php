<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $connection = 'basesistema';
    protected $table = 'consultas'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('empresa_id', 'cliente_id', 'medico_id', 'data', 'horario_consulta', 'status', 'usuario_id'); //Informações que serão gravadas no banco
}


