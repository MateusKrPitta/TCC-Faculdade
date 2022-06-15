<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendasproduto extends Model {

	protected $connection = 'basesistema';
	protected $table = 'vendasprodutos'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('empresa_id', 'venda_id', 'produto_id', 'usuario_id', 'status'); //Informações que serão gravadas no banco

}
