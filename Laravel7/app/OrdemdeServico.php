<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdemdeServico extends Model {

	protected $connection = 'basesistema';
	protected $table = 'ordemdeservicos'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('empresa_id', 'cliente_id', 'ordemdeservico_id','valor', 'usuario_id','status');
	//
}
