<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alimentacao extends Model {

    protected $table = 'alimentacaos'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('empresa_id', 'animal_id', 'alimento_id', 'peso', 'dataalimentacao', 'status', 'usuario_id'); //Informações que serão gravadas no banco

}
