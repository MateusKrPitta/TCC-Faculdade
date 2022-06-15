<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Fundodecaixa; //Adicionado por Cezar
use App\Http\Requests\FundodecaixaRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar

class FundodecaixaController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        return view('admin.home.emdesenvolvimento');
        return view('admin.fundodecaixa.cadastrar');
    }

    public function gravar(FundodecaixaRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Fundodecaixa::create($dados);
        return redirect('/fundodecaixa/cadastrar')->withInput();
    }

    public function editar() {
        return view('admin.home.emdesenvolvimento');
        $id = Request::route('id');
        $fundodecaixa = DB::select('select * from fundodecaixas where id = ?', [$id]);
        return view('admin.fundodecaixa.editar')->with('fundodecaixa', $fundodecaixa);
    }

    public function atualizar() {
        $dados = Request::all();
        $fundodecaixa = Fundodecaixa::find($dados['id']);
        $fundodecaixa->nome = $dados['nome'];
        $fundodecaixa->parcela = $dados['parcela'];
        $fundodecaixa->planodecontas_id = $dados['planodecontas_id'];
        $fundodecaixa->status = $dados['status'];
        $fundodecaixa->save();
        return redirect('/fundodecaixa/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        return view('admin.home.emdesenvolvimento');
        $fundodecaixas = DB::table('fundodecaixas')->orderBy('nome')
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
        return view('admin.fundodecaixa.listar', compact('fundodecaixas', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $fundodecaixa = Fundodecaixa::find($id);
        if($fundodecaixa) {           
            $fundodecaixa->delete();
        }
        return redirect('/fundodecaixa/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('fundodecaixas')->where('id', $id)->update(['status' => '0']);
        return redirect('/fundodecaixa/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('fundodecaixas')->where('id', $id)->update(['status' => '1']);
        return redirect('/fundodecaixa/listar')->withInput(); //redireciona por url
    }


}
