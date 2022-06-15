<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model {

	protected $connection = 'basesistema';
	protected $table = 'empresas'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('nome', 'razaosocial', 'cpfcnpj', 'rgie', 'status', 'observacao', 'usuario_id'); //Informações que serão gravadas no banco

}
