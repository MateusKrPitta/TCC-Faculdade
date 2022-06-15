<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model {

	protected $connection = 'basesistema';
	protected $table = 'servicos'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('nome', 'valor', 'tempo', 'status', 'observacao', 'usuario_id','empresa_id'); //Informações que serão gravadas no banco
        
}
