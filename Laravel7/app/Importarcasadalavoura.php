<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Importarcasadalavoura extends Model {

	protected $connection = 'baseorigem';
	protected $table = 'TRANSAC'; // Nome da Tabela no banco de dados
	protected $primaryKey = 'CODI_TRA';
	protected $sequence = 'GEN_CODI_TRA';
	public $timestamps = false;
	//public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	//protected $fillable = array('CODI_TRA', 'RAZA_TRA', 'FANT_TRA'); //Informações que serão gravadas no banco

}
