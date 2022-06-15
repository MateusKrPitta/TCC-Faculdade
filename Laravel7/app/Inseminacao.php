<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inseminacao extends Model
{
    //
	protected $table = 'inseminacaos'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('empresa_id', 'animal_id', 'datainseminacao', 'turno', 'touro', 'inseminador', 'status_inseminacao', 'usuario_id'); //Informações que serão gravadas no banco

}
