<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacina extends Model
{
    protected $table = 'vacinas'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('nomevacina', 'sexoaplicacao', 'datainicio', 'datafim', 'tipovacina', 'intervalovacina', 'status', 'usuario_id', 'empresa_id'); //Informações que serão gravadas no banco
    
    public function filtro(Array $dados, $linhasNaPagina) {
        return $this->where(function ($query) use ($dados) {
                            if (isset($dados['nomevacina']))
                                $query->where('nomevacina', 'ilike', '%' . $dados['nomevacina'] . '%');
                        })
                        ->orderBy('nomevacina')->where('empresa_id', Usuario::empresa())->paginate($linhasNaPagina);
    }
}
