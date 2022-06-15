<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model {

	protected $connection = 'basesistema';
	protected $table = 'configuracaos'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('empresa_id', 'diasdegestacao', 'mesesparaprimeirainseminacao', 'pesominimoparainseminacao', 'diasparainseminacao', 'diasparaconfirmacaodeinseminacao', 'diasparasecaravacaantesdoparto', 'usuario_id'); //Informações que serão gravadas no banco

}
