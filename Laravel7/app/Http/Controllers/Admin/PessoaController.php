<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Pessoa; //Adicionado por Cezar
use App\Http\Requests\PessoaRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar

class PessoaController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        return view('admin.pessoa.cadastrar');
    }

    public function gravar(PessoaRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Pessoa::create($dados);
        return redirect('/pessoa/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $pessoa = DB::select('select * from pessoas where id = ?', [$id]);
        return view('admin.pessoa.editar')->with('pessoa', $pessoa);
    }

    public function atualizar() {
        $dados = Request::all();
        $pessoa = Pessoa::find($dados['id']);
        $pessoa->nome = $dados['nome'];
        $pessoa->parcela = $dados['parcela'];
        $pessoa->planodecontas_id = $dados['planodecontas_id'];
        $pessoa->status = $dados['status'];
        $pessoa->save();
        return redirect('/pessoa/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $pessoas = DB::table('pessoas')->orderBy('nome')
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
        return view('admin.pessoa.listar', compact('pessoas', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $pessoa = Pessoa::find($id);
        if($pessoa) {           
            $pessoa->delete();
        }
        return redirect('/pessoa/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('pessoas')->where('id', $id)->update(['status' => '0']);
        return redirect('/pessoa/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('pessoas')->where('id', $id)->update(['status' => '1']);
        return redirect('/pessoa/listar')->withInput(); //redireciona por url
    }


}
