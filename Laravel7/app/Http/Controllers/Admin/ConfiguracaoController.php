<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Configuracao; //Adicionado por Cezar
use App\Http\Requests\ConfiguracaoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo


class ConfiguracaoController extends Controller {

    //

    public function editar() {
        $configuracao = DB::table('configuracaos')
                ->where('empresa_id', \App\Usuario::empresa())
               ->first();
               if(!isset($configuracao)){
                   $configuracaodaempresa = new Configuracao();
                   $configuracaodaempresa->empresa_id = \App\Usuario::empresa();
                   $configuracaodaempresa->diasdegestacao = '270';
                   $configuracaodaempresa->mesesparaprimeirainseminacao = '24';
                   $configuracaodaempresa->pesominimoparainseminacao = '350';
                   $configuracaodaempresa->diasparainseminacao = '50';
                   $configuracaodaempresa->diasparaconfirmacaodeinseminacao = '30';
                   $configuracaodaempresa->diasparasecaravacaantesdoparto = '60';
                   $configuracaodaempresa->usuario_id = \App\Usuario::id();
                   $configuracaodaempresa->save();
                   
               }
        return view('admin.configuracao.editar')->with('configuracao', $configuracao);
    }

    public function atualizar(ConfiguracaoRequest $request) {
        $dados = Request::all();
        $configuracao = Configuracao::find($dados['id']);
        $configuracao->diasdegestacao = $dados['diasdegestacao'];
        $configuracao->mesesparaprimeirainseminacao = $dados['mesesparaprimeirainseminacao'];
        $configuracao->pesominimoparainseminacao = $dados['pesominimoparainseminacao'];
        $configuracao->diasparainseminacao = $dados['diasparainseminacao'];
        $configuracao->diasparaconfirmacaodeinseminacao = $dados['diasparaconfirmacaodeinseminacao'];
        $configuracao->diasparasecaravacaantesdoparto = $dados['diasparasecaravacaantesdoparto'];
        $configuracao->usuario_id = \App\Usuario::id();
        $configuracao->save();
        return redirect('/configuracao/editar')->withInput(); //redireciona por url
    }

    public static function diasdegestacao() {
        $dias = Configuracao::where('id', 1)->get()->toArray();
        //return $dias[0]['diasdegestacao'];
        return 0;
    }

    public static function mesesparaprimeirainseminacao() {
        $meses = DB::select('select mesesparaprimeirainseminacao from configuracaos where id = ?', [1]);
        return $meses[0]->mesesparaprimeirainseminacao;
    }

    public static function pesominimoparainseminacao() {
        $peso = Configuracao::where('id', 1)->get();
        return $peso[0]->pesominimoparainseminacao;
    }

    public static function diasparainseminacao() {
        $dias = Configuracao::find(1)->get();
        return $dias[0]->diasparainseminacao;
    }

    public static function diasparaconfirmacaodeinseminacao() {
        $dias = Configuracao::find(1)->get();
        return $dias[0]->diasparaconfirmacaodeinseminacao;
    }

    public static function diasparasecaravacaantesdoparto() {
        //$dias = Configuracao::find(1)->get();
        //return $dias[0]->diasparasecaravacaantesdoparto;
        return 0;
    }

}
