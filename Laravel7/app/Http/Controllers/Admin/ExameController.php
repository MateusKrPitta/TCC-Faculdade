<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Exame; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use App\Http\Requests\ExameRequest;

//use Illuminate\Http\Request;

class ExameController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        return view('admin.exame.cadastrar');
    }

    public function gravar(ExameRequest $request) {
        $dados = Request::all(); /// pegas todas as informações para transferir para o banco
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Exame::create($dados); /// comando que salva no banco de dados
        return redirect('/exame/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $exames = DB::select('select * from exames where id = ?', [$id]);
        return view('admin.exame.editar')->with('exames', $exames);
    }

    public function atualizar(ExameRequest $request) {
        $dados = Request::all();
        $exames = Exame::find($dados['id']);
        $exames->nome = $dados['nome'];
        $exames->valor = $dados['valor'];
        $exames->valor_referencia = $dados['valor_referencia'];
        $exames->descricao = $dados['descricao'];
        $exames->tempo = $dados['tempo'];
        $exames->status = $dados['status'];
        $exames->save();
        return redirect('/exame/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $exames = DB::table('exames')->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->paginate($this->linhasNaPagina);
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Valor', 'width' => 5],
            ['label' => 'Valor Referência', 'width' => 5],
            ['label' => 'Tempo', 'width' => 5],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 3, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.exame.listar', compact('exames', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $exames = Exame::find($id);
        if ($exames) {
            $exames->delete();
        }
        return redirect('/exame/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('exames')->where('id', $id)->update(['status' => '0']);
        return redirect('/exame/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('exames')->where('id', $id)->update(['status' => '1']);
        return redirect('/exame/listar')->withInput(); //redireciona por url
    }

}
