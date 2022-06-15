<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viagem extends Model {

	protected $connection = 'basesistema';
	protected $table = 'viagems'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('empresa_id', 'nome', 'origem', 'destino', 'data', 'hora', 'valor', 'veiculo_id', 'status', 'observacao', 'usuario_id'); //Informações que serão gravadas no banco

}
