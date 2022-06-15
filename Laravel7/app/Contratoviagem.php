<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contratoviagem extends Model {

	protected $connection = 'basesistema';
	protected $table = 'contratoviagems'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('empresa_id', 'cliente_id', 'veiculo_id', 'itinerario', 'valor', 'localembarqueinicio', 'datainicio', 'horainicio', 'localdedestino', 'localembarqueretorno', 'dataretorno', 'horaretorno', 'observacao', 'datadocontrato', 'status', 'usuario_id'); //Informações que serão gravadas no banco

}
