<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contratoconvenio extends Model {

	protected $connection = 'basesistema';
	protected $table = 'contratoconvenios'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('empresa_id', 'conveniado_id', 'plano_id', 'valor', 'formadepagamento_id', 'observacao', 'datadocontrato', 'status', 'usuario_id'); //Informações que serão gravadas no banco

}
