<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model {

	protected $connection = 'basesistema';
	protected $table = 'vendas'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('empresa_id', 'cliente_id', 'formadepagamentos_id', 'usuario_id', 'status'); //Informações que serão gravadas no banco

}
