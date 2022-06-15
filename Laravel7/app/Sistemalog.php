<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Usuario;

class Sistemalog extends Model {

    protected $connection = 'basesistema';
    protected $table = 'sistemalogs'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array('empresa_id', 'usuario_id', 'modulo', 'acao', 'antes', 'depois'); //Informações que serão gravadas no banco

    public static function registra($empresa_id, $usuario_id, $modulo, $acao, $antes, $depois) {
        $dados['empresa_id'] = $empresa_id;
        $dados['usuario_id'] = $usuario_id;
        $dados['modulo'] = $modulo;
        $dados['acao'] = $acao;
        $dados['antes'] = $antes;
        $dados['depois'] = $depois;
        Sistemalog::create($dados);
    }

}
