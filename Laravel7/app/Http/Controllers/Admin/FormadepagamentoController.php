<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Formadepagamento; //Adicionado por Cezar
use App\Http\Requests\FormadepagamentoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar

class FormadepagamentoController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        return view('admin.formadepagamento.cadastrar');
    }

    public function gravar(FormadepagamentoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Formadepagamento::create($dados);
        return redirect('/formadepagamento/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $formadepagamento = DB::select('select * from formadepagamentos where id = ?', [$id]);
        return view('admin.formadepagamento.editar')->with('formadepagamento', $formadepagamento);
    }

    public function atualizar() {
        $dados = Request::all();
        $formadepagamento = Formadepagamento::find($dados['id']);
        $formadepagamento->nome = $dados['nome'];
        $formadepagamento->parcela = $dados['parcela'];
        $formadepagamento->planodecontas_id = $dados['planodecontas_id'];
        $formadepagamento->status = $dados['status'];
        $formadepagamento->save();
        return redirect('/formadepagamento/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $formadepagamentos = DB::table('formadepagamentos')->orderBy('nome')
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
        return view('admin.formadepagamento.listar', compact('formadepagamentos', 'cabecalho', 'config'));
    }

    public function listarfiltro(Request $request, Formadepagamento $formadepagamento) {
        //dd(Request::all());
        $dadosFiltro = Request::all();
        $formadepagamentos = $formadepagamento->filtro($dadosFiltro, $this->linhasNaPagina);
        return view('admin.formadepagamento.listar', compact('formadepagamentos'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $formadepagamento = Formadepagamento::find($id);
        if($formadepagamento) {           
            $formadepagamento->delete();
        }
        return redirect('/formadepagamento/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('formadepagamentos')->where('id', $id)->update(['status' => '0']);
        return redirect('/formadepagamento/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('formadepagamentos')->where('id', $id)->update(['status' => '1']);
        return redirect('/formadepagamento/listar')->withInput(); //redireciona por url
    }


}
