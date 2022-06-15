<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    //
	protected $connection = 'basesistema';
	protected $table = 'enderecos'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('cliente_id', 'logradouro', 'numero', 'bairro', 'complemento', 'cidade', 'estado', 'cep', 'usuario_id'); //Informações que serão gravadas no banco

}
