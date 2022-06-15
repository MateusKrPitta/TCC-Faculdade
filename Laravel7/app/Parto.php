<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parto extends Model
{
    //
	protected $table = 'partos'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('empresa_id', 'animal_id', 'inseminacao_id', 'gestacao_id', 'dataparto', 'acompanhante', 'status_parto', 'usuario_id'); //Informações que serão gravadas no banco
}
