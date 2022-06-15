<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
        protected $connection = 'basesistema';
	protected $table = 'matriculas'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	//Informações que serão gravadas no banco
	protected $fillable = array(
                'empresa_id',
		'aluno_id', 
		'turma_id',
		'valor_matricula',
		'valor_mensalidade',
		'observacoes',
		'status',
		'usuario_id'
		); 
        

}
