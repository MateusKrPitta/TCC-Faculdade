<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model {

	protected $connection = 'basesistema';
	protected $table = 'agendas'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('empresa_id', 'nome', 'evento', 'data', 'hora', 'status', 'observacao', 'usuario_id'); //Informações que serão gravadas no banco

}
