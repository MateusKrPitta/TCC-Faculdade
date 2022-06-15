<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passagem extends Model {

    protected $connection = 'basesistema';
    protected $table = 'passagems'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('empresa_id', 'viagem_id', 'cliente_id', 'localembarque', 'acento', 'valor', 'pagamento', 'status', 'usuario_id'); //Informações que serão gravadas no banco
    
    public function filtro(Array $dados, $linhasNaPagina) {
        return $this->where(function ($query) use ($dados) {
                            if (isset($dados['nome']))
                                $query->where('nome', 'ilike', '%' . $dados['nome'] . '%');
                            if (isset($dados['cpfcnpj']))
                                $query->where('cpfcnpj', 'ilike', '%' . $dados['cpfcnpj'] . '%');
                        })
                        ->orderBy('nome')->where('empresa_id', Usuario::empresa())->paginate($linhasNaPagina);
    }
    
    public function viagem() {
        return $this->belongsTo(Viagem::class);
    }

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function usuario() {
        return $this->belongsTo(Usuario::class);
    }

}
