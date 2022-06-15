<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Projeto; //Adicionado por Cezar
use App\Http\Requests\ProjetoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar

class ProjetoController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        return view('admin.projeto.cadastrar');
    }

    public function gravar(ProjetoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Projeto::create($dados);
        return redirect('/projeto/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $projeto = DB::select('select * from projetos where id = ?', [$id]);
        return view('admin.projeto.editar')->with('projeto', $projeto);
    }

    public function atualizar() {
        $dados = Request::all();
        $projeto = Projeto::find($dados['id']);
        $projeto->nome = $dados['nome'];
        $projeto->parcela = $dados['parcela'];
        $projeto->planodecontas_id = $dados['planodecontas_id'];
        $projeto->status = $dados['status'];
        $projeto->save();
        return redirect('/projeto/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $projetos = DB::table('projetos')->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Nome', 'width' => 6],
            ['label' => 'Parcela', 'width' => 1],
            ['label' => 'Plano de Contas', 'width' => 3],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 1, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.projeto.listar', compact('projetos', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $projeto = Projeto::find($id);
        if($projeto) {           
            $projeto->delete();
        }
        return redirect('/projeto/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('projetos')->where('id', $id)->update(['status' => '0']);
        return redirect('/projeto/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('projetos')->where('id', $id)->update(['status' => '1']);
        return redirect('/projeto/listar')->withInput(); //redireciona por url
    }


}
