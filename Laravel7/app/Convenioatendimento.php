<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convenioatendimento extends Model {

    protected $connection = 'basesistema';
    protected $table = 'convenioatendimentos'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('empresa_id', 'conveniado_id', 'credenciado_id', 'data', 'tipodeatendimento', 'valor', 'nomedoresponsavel', 'status', 'observacao', 'usuario_id'); //Informações que serão gravadas no banco


    //Coloca todas as letras em maiusculas antes de gravar no banco de dados
    public function setNomedoresponsavelAttribute($value) {
        $this->attributes['nomedoresponsavel'] = mb_strtoupper($value);
    }

}
