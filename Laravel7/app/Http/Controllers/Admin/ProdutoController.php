<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Produto; //Adicionado por Cezar
use App\Http\Requests\ProdutoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario;

class ProdutoController extends Controller {

    private $linhasporpagina = 2;

    public function cadastrar() {
        return view('admin.produto.cadastrar');
    }

    public function gravar(ProdutoRequest $request) {
        $dados = $request->all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        $dados['valor'] = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor
        Produto::create($dados);
        return redirect('/produto/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $produto = DB::select('select * from produtos where id = ?', [$id]);
        return view('admin.produto.editar')->with('produto', $produto);
    }

    public function atualizar() {
        $dados = Request::all();
        $produto = Produto::find($dados['id']);
        $produto->nome = $dados['nome'];
        $produto->razaosocial = $dados['razaosocial'];
        $produto->cpfcnpj = $dados['cpfcnpj'];
        $produto->rgie = $dados['rgie'];
        $produto->nascimento = $dados['nascimento'];
        $produto->save();
        return redirect('/produto/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $produtos = Produto::paginate($this->linhasporpagina);
       
        $cabecalho = [
            ['label' => 'Produto', 'width' => 10],
            ['label' => 'Código de Barras', 'width' => 10],
            ['label' => 'Valor', 'width' => 5],
            ['label' => 'Quantiadde', 'width' => 5],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 3, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
         return view('admin.produto.listar', compact('produtos', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $produto = Produto::find($id);
        if ($produto) {
            $produto->delete();
        }
        return redirect('/produto/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('produtos')->where('id', $id)->update(['status' => '0']);
        return redirect('/produto/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('produtos')->where('id', $id)->update(['status' => '1']);
        return redirect('/produto/listar')->withInput(); //redireciona por url
    }

}
