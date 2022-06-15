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
use App\Parto; //Adicionado por Cezar
use App\Http\Requests\PartoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario;

class PartoController extends Controller {

    //
    public function cadastrar() {
        $listadeanimais = Gestacao::leftJoin('animals', 'gestacaos.animal_id', '=', 'animals.id')
                ->leftJoin('partos', 'gestacaos.id', '=', 'partos.gestacao_id')
                ->select('animals.id as animal_id', 'gestacaos.id as gestacao_id', 'animals.nome as animal_nome')
                ->where('status_gestacao', '=', '1')
                ->where('dataparto', '=', null)
                ->orderBy('dataconfirmacao', 'desc')
                ->get();
        return view('admin.parto.cadastrar')->with('listadeanimais', $listadeanimais)->with('usuario_id', auth()->user()->id);
    }

    public function cadastrarFilhote($dados) {
        $parto = Parto::where('gestacao_id', $dados['gestacao_id'])->first();
        $inseminacao = Inseminacao::where('id', $parto['inseminacao_id'])->first();
        $animal_mae = Animal::where('id', $inseminacao['animal_id'])->first();
        $animal = new Animal;

        //Nome
        if (isset($dados['nome'])) {
            $animal->nome = $dados['nome'];
        } else {
            $animal->nome = "Filhote";
        }

        //Numero
        if (isset($dados['numero'])) {
            $animal->numero = $dados['numero'];
        } else {
            $animal->numero = "0";
        }

        //Peso
        if (isset($dados['peso'])) {
            $animal->peso = $dados['peso'];
        } else {
            $animal->peso = "70";
        }

        //Sexo
        if (isset($dados['sexo'])) {
            $animal->sexo = $dados['sexo'];
        } else {
            $animal->sexo = "F";
        }

        //Nascimento
        if (isset($dados['dataparto'])) {
            $animal->nascimento = $dados['dataparto'];
        } else {
            $animal->nascimento = "2000-01-01";
        }
        //Empresa
        if (isset($dados['empresa_id'])) {
            $animal->empresa_id = $dados['empresa_id'];
        } else {
            $animal->empresa_id = Usuario::empresa();
        }

        $animal->pai = $inseminacao['touro'];
        $animal->mae = $animal_mae['nome'];
        $animal->status = 1;
        $animal->usuario_id = auth()->user()->id;
        $animal->save();
        return $animal->id;
    }

//Fim cadastrar Filhote

    public function gravar(PartoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        
        DB::beginTransaction();
        $cadastraParto = Parto::create($dados);
        // Adiciona o código do animal na tabela de partos
        $gestacao = Gestacao::where('id', $dados['gestacao_id'])->first();
        $atualizaParto = DB::table('partos')
                ->where('gestacao_id', $dados['gestacao_id'])
                ->update(['animal_id' => $gestacao->animal_id, 'inseminacao_id' => $gestacao->inseminacao_id]);
        $atualizaInseminacao = DB::table('insemnacaos')
                ->where('id', $gestacao->inseminacao_id)
                ->update(['status_inseminacao' => '2']);

        if ($dados['status_parto'] == 'V') {
            //Cadastra o filhote na tabela animais
            $filhote_id = PartoController::cadastrarFilhote($dados);
            //Atualiza o cadastro do parto com o codigo do filhote
            $atualizaFilhote = DB::table('partos')
                    ->where('gestacao_id', $dados['gestacao_id'])
                    ->update(['filhote_id' => $filhote_id]);
        }

        if ($atualizaParto) {
            //Sucesso!
            DB::commit();
        } else {
            //Fail, desfaz as alterações no banco de dados
            DB::rollBack();
        }
        return redirect('/parto/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $parto = DB::select('select * from partos where id = ?', [$id]);
        return view('admin.parto.editar')->with('parto', $parto);
    }

    public function atualizar(PartoRequest $request) {
        $dados = Request::all();
        $parto = Parto::find($dados['id']);
        $parto->nome = $dados['nome'];
        $parto->numero = $dados['numero'];
        $parto->pai = $dados['pai'];
        $parto->mae = $dados['mae'];
        $parto->nascimento = $dados['nascimento'];
        $parto->peso = $dados['peso'];
        $parto->sexo = $dados['sexo'];
        $parto->save();
        return redirect('/parto/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        //$parto = Parto::all()->sort();
        //$parto = Parto::Join('animals', 'partos.animal_id', '=', 'animals.id')->orderBy('dataparto', 'desc')->select()->getQuery()->get();
        $parto = Animal::Join('partos', 'animals.id', '=', 'partos.animal_id')->orderBy('dataparto', 'desc')->select()->getQuery()->get();
        //dd($parto);
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Data do Parto', 'width' => 5],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 3, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null,  ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.parto.listar', compact('parto', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $parto = Parto::find($id);
        if ($parto) {
            $parto->delete();
        }
        return redirect('/parto/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('partos')->where('id', $id)->update(['status_parto' => 'M']);
        return redirect('/parto/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('partos')->where('id', $id)->update(['status_parto' => 'V']);
        return redirect('/parto/listar')->withInput(); //redireciona por url
    }

    public static function baixamensal() {
        $ummesatras = Carbon::now('America/Campo_Grande')->addDay(-30); //Pega a data atual e subtrai 30 dias
        return DB::table('partos')->where('status', 0)->where('updated_at', '>', $ummesatras)->count(); //Busca no banco e conta a quantidade de resultados
    }

    public static function novosmensal() {
        $ummesatras = Carbon::now('America/Campo_Grande')->addDay(-30); //Pega a data atual e subtrai 30 dias
        return DB::table('partos')->where('status', 1)->where('updated_at', '>', $ummesatras)->count(); //Busca no banco e conta a quantidade de resultados
    }

    public static function semconfirmacao() {
        return DB::table('partos')->where('status', 1)->count(); //Busca no banco e conta a quantidade de resultados
    }

}
