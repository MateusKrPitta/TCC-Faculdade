<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartao extends Model {

    protected $connection = 'basesistema';
    protected $table = 'cartaos'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('empresa_id', 'conveniado_id', 'nomenocartao', 'numeronocartao', 'datadeemissao', 'datadevalidade', 'status', 'usuario_id'); //Informações que serão gravadas no banco

    //Coloca todas as letras em maiusculas antes de gravar no banco de dados
    public function setNomenocartaoAttribute($value) {
        $this->attributes['nomenocartao'] = mb_strtoupper($value);
    }

}
