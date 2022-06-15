<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model {

    //
    protected $connection = 'basesistema';
    protected $table = 'turmas'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    //Informações que serão gravadas no banco
    protected $fillable = array(
        'empresa_id',
        'nome',
        'ano',
        'periodo',
        'observacoes',
        'status',
        'usuario_id'
    );
    public function filtro(Array $dados, $linhasNaPagina) {
        return $this->where(function ($query) use ($dados) {
                            if (isset($dados['nome']))
                                $query->where('nome', 'ilike', '%' . $dados['nome'] . '%');

                        })
                        ->orderBy('nome')->where('empresa_id', Usuario::empresa())->paginate($linhasNaPagina);
    }

}
