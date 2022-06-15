<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model {

    protected $connection = 'basesistema';
    protected $table = 'clientes'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('empresa_id', 'nome', 'razaosocial', 'cpfcnpj', 'rgie', 'nascimento', 'tel1', 'tel2', 'sexo', 'logradouro', 'numero', 'bairro', 'complemento', 'cidade', 'estado', 'cep', 'status', 'observacoes', 'usuario_id', 'created_at', 'updated_at', 'email', 'contatonome', 'contatotelefone', 'contatoemail'); //Informações que serão gravadas no banco

    public function filtro(Array $dados, $linhasNaPagina) {
        return $this->where(function ($query) use ($dados) {
                            if (isset($dados['nome']))
                                $query->where('nome', 'ilike', '%' . $dados['nome'] . '%');
                            if (isset($dados['cpfcnpj']))
                                $query->where('cpfcnpj', 'ilike', '%' . $dados['cpfcnpj'] . '%');
                        })
                        ->orderBy('nome')
                        ->where('empresa_id', Usuario::empresa())
                        ->paginate($linhasNaPagina);
    }

    //Coloca todas as letras em maiusculas antes de gravar no banco de dados
    public function setNomeAttribute($value) {
        $this->attributes['nome'] = mb_strtoupper($value);
    }

    //Coloca todas as letras em maiusculas antes de gravar no banco de dados
    public function setRazaosocialAttribute($value) {
        $this->attributes['razaosocial'] = mb_strtoupper($value);
    }

}
