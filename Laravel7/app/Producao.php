<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producao extends Model
{
   	protected $table = 'producaos'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('empresa_id', 'animal_id', 'data_producao', 'hora_producao', 'quantidade', 'usuario_id'); //Informações que serão gravadas no banco
        
        public function filtro(Array $dados, $linhasNaPagina) {
        return $this->where(function ($query) use ($dados) {
                            if (isset($dados['animal_id']))
                                $query->where('animal_id', 'ilike', '%' . $dados['animal_id'] . '%');

                        })
                        ->orderBy('animal_id')->where('empresa_id', Usuario::empresa())->paginate($linhasNaPagina);
        
}
}