<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credenciado extends Model {

    protected $connection = 'basesistema';
    protected $table = 'credenciados'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('empresa_id', 'nome', 'cpfcnpj', 'rgie', 'nascimento', 'tel1', 'tel2', 'sexo', 'whatsapp', 'instagram', 'facebook', 'email', 'site', 'logradouro', 'numero', 'bairro', 'complemento', 'cidade', 'estado', 'cep', 'credenciadocategoria_id', 'status', 'observacao', 'usuario_id', 'imagem'); //Informações que serão gravadas no banco

    public function filtro(Array $dados, $linhasNaPagina) {
        return $this->where(function ($query) use ($dados) {
                            if (isset($dados['nome']))
                                $query->where('nome', 'ilike', '%' . $dados['nome'] . '%');
                            if (isset($dados['cpfcnpj']))
                                $query->where('cpfcnpj', 'ilike', '%' . $dados['cpfcnpj'] . '%');
                        })
                        ->orderBy('nome')->where('empresa_id', Usuario::empresa())->paginate($linhasNaPagina);
    }

    public function setNomeAttribute($value) {
        $this->attributes['nome'] = mb_strtoupper($value);
    }

    //Relacionamento.
    public function users() {
        //    $this->belongsToMany('tabela com relacao com esta model', 'nome da tabela pivot', 'key ref. credenciado em pivot', 'key ref. user em pivot')
        return $this->belongsToMany('app\Usuario', 'userscredenciados', 'credenciado_id', 'user_id')->withPivot(['status', 'created_at', 'updated_at']);
    }

}
