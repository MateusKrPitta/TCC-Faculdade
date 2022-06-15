<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contasapagar extends Model {

	protected $connection = 'basesistema';
	protected $table = 'contasapagars'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('empresa_id','fornecedor_id', 'descricao', 'valor', 'valordesconto', 'valoracrescimo', 'vencimento', 'pagamento', 'status', 'observacao', 'usuario_id', 'formadepagamento_id'); //Informações que serão gravadas no banco

//
}
