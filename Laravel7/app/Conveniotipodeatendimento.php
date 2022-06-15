<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conveniotipodeatendimento extends Model {

    protected $connection = 'basesistema';
    protected $table = 'conveniotipodeatendimentos'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('empresa_id', 'nome', 'status', 'usuario_id'); //Informações que serão gravadas no banco


    //Coloca todas as letras em maiusculas antes de gravar no banco de dados
    public function setNomedoresponsavelAttribute($value) {
        $this->attributes['nome'] = mb_strtoupper($value);
    }

}
