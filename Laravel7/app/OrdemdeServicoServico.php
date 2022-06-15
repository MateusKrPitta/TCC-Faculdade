<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdemdeServicoServico extends Model {

	protected $connection = 'basesistema';
        protected $table = 'ordemdeservicoservico'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('empresa_id', 'ordemdeservico_id', 'servico_id',  'usuario_id','status');
	//
}
