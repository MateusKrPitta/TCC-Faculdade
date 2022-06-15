<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdemdeServicoProduto extends Model {

	protected $connection = 'basesistema';
	protected $table = 'ordemdeservicoprodutos'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('empresa_id', 'ordemdeservico_id', 'produto_id', 'usuario_id','status');
	//
}
