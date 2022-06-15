<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Animal; //Adicionado por Cezar
use App\Alimento; //Adicionado por Cezar
use App\Alimentacao; //Adicionado por Cezar
use App\Http\Requests\AlimentacaoRequest; //Adicionado por Cezar
use App\Usuario;

class AlimentacaoController extends Controller {
    private $linhasNaPagina = 7;

    public function cadastrar() {
        $alimentos = Alimento::all()->sort();
        $listadeanimais = Animal::all()->sort();
        return view('admin.alimentacao.cadastrar')->with('usuario_id', auth()->user()->id)->with('alimentos', $alimentos)->with('animais', $listadeanimais);
    }

    public function gravar(AlimentacaoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id; 
        Alimentacao::create($dados);
        return redirect('/alimentacao/cadastrar')->withInput();
        
    }

    public function editar() {
        $id = Request::route('id');
        $animals = DB::table('animals')
                ->where('empresa_id', Usuario::empresa())
                ->get();	
        $alimentos = DB::table('alimentos')
                ->where('empresa_id', Usuario::empresa())
                ->get();
        $alimentacao = DB::table('alimentacaos')
                ->where('empresa_id', Usuario::empresa())
                ->where('id', $id)
                ->first();
        return view('admin.alimentacao.editar')
                ->with('alimentos', $alimentos)
                ->with('animals', $animals)
                ->with('alimentacao', $alimentacao);
    }

    public function atualizar(AlimentacaoRequest $request) {
         $dados = Request::all();
        $alimentacao = Alimentacao::find($dados['id']);
        $alimentacao->animal_id = $dados['animal_id'];
        $alimentacao->alimento_id = $dados['alimento_id'];
        $alimentacao->peso = $dados['peso'];
        $alimentacao->dataalimentacao = $dados['dataalimentacao'];
        $alimentacao->save();

        return redirect('/alimentacao/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $alimentacaos = DB::table('alimentacaos')
                ->where('alimentacaos.empresa_id', Usuario::empresa())
                ->leftJoin('animals', 'alimentacaos.animal_id', '=', 'animals.id')
                ->leftJoin('alimentos', 'alimentacaos.alimento_id', '=', 'alimentos.id')
                ->select('alimentacaos.id as id',
                        'animals.nome as animal_nome',
                        'alimentos.nome as alimento_nome',
                        'alimentacaos.peso as peso',
                        'alimentacaos.dataalimentacao as dataalimentacao',
                        'alimentacaos.status as status')
                ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Alimento', 'width' => 3],
            ['label' => 'Peso', 'width' => 1],
            ['label' => 'Data', 'width' => 2],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 2, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.alimentacao.listar', compact('alimentacaos', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $alimentacao = Alimentacao::find($id);
        if($alimentacao) {           
            $alimentacao->delete();
        }
        return redirect('/alimentacao/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('alimentacaos')->where('id', $id)->update(['status' => '0']);
        return redirect('/alimentacao/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('alimentacaos')->where('id', $id)->update(['status' => '1']);
        return redirect('/alimentacao/listar')->withInput(); //redireciona por url
    }

}
