<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gestacao extends Model
{
    //
	protected $table = 'gestacaos'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('empresa_id', 'animal_id', 'inseminacao_id', 'dataconfirmacao', 'examinador', 'status_gestacao', 'usuario_id'); //Informações que serão gravadas no banco

}
