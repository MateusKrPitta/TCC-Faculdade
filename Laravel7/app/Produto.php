<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model {

	protected $connection = 'basesistema';
	protected $table = 'produtos'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('empresa_id','nome', 'codbarras', 'valor','valordecompra', 'quantidade','localdeestoque', 'unidade', 'marca', 'status', 'observacao', 'usuario_id'); //Informações que serão gravadas no banco

}
