<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Animal; //Adicionado por Cezar
use App\Gestacao; //Adicionado por Cezar
use App\Inseminacao; //Adicionado por Cezar
use App\Http\Requests\GestacaoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario;

class GestacaoController extends Controller {


    public function cadastrar() {
        $diasconfirmacao = DB::table('configuracaos')
                ->where('empresa_id', Usuario::empresa())
                ->first();
        //procura sempre a tabela 
        $listadeanimais = DB::table('animals')
                ->join('inseminacaos', 'animals.id', '=', 'inseminacaos.animal_id')
                ->select('animals.*','inseminacaos.*')
                ->where('inseminacaos.status_inseminacao', '=', '0')
                ->where('inseminacaos.datainseminacao', '<', date('Y-m-d', strtotime('-'.$diasconfirmacao->diasparaconfirmacaodeinseminacao.' days', strtotime( today() ))) )
                ->orderBy('inseminacaos.datainseminacao', 'desc')
                ->get();
        
        return view('admin.gestacao.cadastrar')->with('listadeanimais', $listadeanimais)->with('usuario_id', auth()->user()->id);
    }

    public function gravar(GestacaoRequest $request) {      
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        DB::beginTransaction();
        $cadastraGestacao = Gestacao::create($dados);

        if ($dados['status_gestacao'] == 1) {
            $atualizaInseminacao = DB::table('inseminacaos')->where('id', $dados['inseminacao_id'])->update(['status_inseminacao' => '1']);
        }
        if ($dados['status_gestacao'] == 2) {
            $atualizaInseminacao = DB::table('inseminacaos')->where('id', $dados['inseminacao_id'])->update(['status_inseminacao' => '2']);
        }
        // Adiciona o código do animal na tabela de gestação
        $id_animal = Inseminacao::where('id', $dados['inseminacao_id'])->get()->toArray();
        DB::table('gestacaos')->where('inseminacao_id', $dados['inseminacao_id'])->update(['animal_id' => $id_animal[0]['animal_id']]);

        if ($cadastraGestacao && $atualizaInseminacao) {
            //Sucesso!
            DB::commit();
            return redirect('/gestacao/cadastrar')->withInput();
        } else {
            //Fail, desfaz as alterações no banco de dados
            DB::rollBack();
            return redirect('/gestacao/cadastrar')->withInput();
        }
    }

    public function editar() {
        $id = Request::route('id');
        $gestacao = DB::select('select * from animals where id = ?', [$id]);
        return view('admin.gestacao.editar')->with('gestacao', $gestacao);
    }

    public function atualizar(GestacaoRequest $request) {
        $dados = Request::all();
        $gestacao = Gestacao::find($dados['id']);
        $gestacao->nome = $dados['nome'];
        $gestacao->numero = $dados['numero'];
        $gestacao->pai = $dados['pai'];
        $gestacao->mae = $dados['mae'];
        $gestacao->nascimento = $dados['nascimento'];
        $gestacao->peso = $dados['peso'];
        $gestacao->sexo = $dados['sexo'];
        $gestacao->save();
        return redirect('/gestacao/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        //$gestacao = Gestacao::all()->sort();
        //$gestacao = Gestacao::Join('animals', 'gestacaos.animal_id', '=', 'animals.id')->orderBy('datagestacao', 'desc')->select()->getQuery()->get();
        $gestacao = Animal::Join('gestacaos', 'animals.id', '=', 'gestacaos.animal_id')->orderBy('dataconfirmacao', 'desc')->select()->getQuery()->get();
        //dd($gestacao);
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Data Confirmação', 'width' => 5],
            ['label' => 'Examinador', 'width' => 10],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 3, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.gestacao.listar', compact('gestacao', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $gestacao = Gestacao::find($id);
        if($gestacao) {           
            $gestacao->delete();
        }
        return redirect('/gestacao/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('gestacaos')->where('id', $id)->update(['status_gestacao' => '2']);
        return redirect('/gestacao/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('gestacaos')->where('id', $id)->update(['status_gestacao' => '1']);
        return redirect('/gestacao/listar')->withInput(); //redireciona por url
    }

    public static function vacas_para_secar() {
        $dias_de_gestacao = ConfiguracaoController::diasdegestacao();
        $dias_para_secar = ConfiguracaoController::diasparasecaravacaantesdoparto();
        $inicio = Carbon::now('America/Campo_Grande')->addDay(($dias_de_gestacao)*(-1));
        $fim = Carbon::now('America/Campo_Grande')->addDay((($dias_de_gestacao)-($dias_para_secar))*(-1));
        return DB::table('inseminacaos')->where('status_inseminacao', 1)->where('datainseminacao', '>', $inicio)->where('datainseminacao', '<', $fim)->count(); //Busca no banco e conta a quantidade de resultados
    }

    public static function vacas_gestacionando() {
        $dias_de_gestacao = ConfiguracaoController::diasdegestacao();
        $dias_para_secar = ConfiguracaoController::diasparasecaravacaantesdoparto();
        $inicio = Carbon::now('America/Campo_Grande')->addDay(($dias_de_gestacao)*(-1));
        $fim = Carbon::now('America/Campo_Grande')->addDay(-1);
        return DB::table('inseminacaos')->where('status_inseminacao', 1)->where('datainseminacao', '>', $inicio)->where('datainseminacao', '<', $fim)->count(); //Busca no banco e conta a quantidade de resultados
    }

    public static function previsao_de_nascimento() {
        $dias_de_gestacao = ConfiguracaoController::diasdegestacao();
        $dias_para_secar = ConfiguracaoController::diasparasecaravacaantesdoparto();
        $inicio = Carbon::now('America/Campo_Grande')->addDay(($dias_de_gestacao)*(-1));
        $fim = Carbon::now('America/Campo_Grande')->addDay((($dias_de_gestacao)*(-1))+30);
        return DB::table('inseminacaos')->where('status_inseminacao', 1)->where('datainseminacao', '>', $inicio)->where('datainseminacao', '<', $fim)->count(); //Busca no banco e conta a quantidade de resultados
    }

}
