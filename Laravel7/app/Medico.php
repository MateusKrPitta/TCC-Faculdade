<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $connection = 'basesistema';
    protected $table = 'medicos'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('empresa_id', 'especialidade_id', 'nome', 'numeroconselhoregional', 'status', 'usuario_id'); //Informações que serão gravadas no banco

    public function filtro(Array $dados, $linhasNaPagina) {
        return $this->where(function ($query) use ($dados) {
                            if (isset($dados['nome']))
                                $query->where('nome', 'ilike', '%' . $dados['nome'] . '%');
                            if (isset($dados['numeroconselhoregional']))
                                $query->where('numeroconselhoregional', 'ilike', '%' . $dados['numeroconselhoregional'] . '%');
                        })
                        ->orderBy('nome')->where('empresa_id', Usuario::empresa())->paginate($linhasNaPagina);
    }

}


