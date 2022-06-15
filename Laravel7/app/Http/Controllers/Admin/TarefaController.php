<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Tarefa; //Adicionado por Cezar
use App\Http\Requests\TarefaRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar

class TarefaController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        return view('admin.tarefa.cadastrar');
    }

    public function gravar(TarefaRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Tarefa::create($dados);
        return redirect('/tarefa/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $tarefa = DB::select('select * from tarefas where id = ?', [$id]);
        return view('admin.tarefa.editar')->with('tarefa', $tarefa);
    }

    public function atualizar() {
        $dados = Request::all();
        $tarefa = Tarefa::find($dados['id']);
        $tarefa->nome = $dados['nome'];
        $tarefa->parcela = $dados['parcela'];
        $tarefa->planodecontas_id = $dados['planodecontas_id'];
        $tarefa->status = $dados['status'];
        $tarefa->save();
        return redirect('/tarefa/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $tarefas = DB::table('tarefas')->orderBy('nome')
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
        return view('admin.tarefa.listar', compact('tarefas', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $tarefa = Tarefa::find($id);
        if($tarefa) {           
            $tarefa->delete();
        }
        return redirect('/tarefa/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('tarefas')->where('id', $id)->update(['status' => '0']);
        return redirect('/tarefa/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('tarefas')->where('id', $id)->update(['status' => '1']);
        return redirect('/tarefa/listar')->withInput(); //redireciona por url
    }


}
