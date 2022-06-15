<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacinacao extends Model {

    //
    protected $table = 'vacinacaos'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('empresa_id', 'animal_id', 'vacina_id', 'datavacina', 'usuario_id'); //Informações que serão gravadas no banco


}
