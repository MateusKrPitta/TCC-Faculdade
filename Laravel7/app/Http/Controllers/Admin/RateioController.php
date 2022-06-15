<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Rateio; //Adicionado por Cezar
use App\Http\Requests\RateioRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar

class RateioController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        return view('admin.home.emdesenvolvimento');
        return view('admin.rateio.cadastrar');
    }

    public function gravar(RateioRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Rateio::create($dados);
        return redirect('/rateio/cadastrar')->withInput();
    }

    public function editar() {
        return view('admin.home.emdesenvolvimento');
        $id = Request::route('id');
        $rateio = DB::select('select * from rateios where id = ?', [$id]);
        return view('admin.rateio.editar')->with('rateio', $rateio);
    }

    public function atualizar() {
        $dados = Request::all();
        $rateio = Rateio::find($dados['id']);
        $rateio->nome = $dados['nome'];
        $rateio->parcela = $dados['parcela'];
        $rateio->planodecontas_id = $dados['planodecontas_id'];
        $rateio->status = $dados['status'];
        $rateio->save();
        return redirect('/rateio/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        return view('admin.home.emdesenvolvimento');
        $rateios = DB::table('rateios')->orderBy('nome')
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
        return view('admin.rateio.listar', compact('rateios', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $rateio = Rateio::find($id);
        if($rateio) {           
            $rateio->delete();
        }
        return redirect('/rateio/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('rateios')->where('id', $id)->update(['status' => '0']);
        return redirect('/rateio/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('rateios')->where('id', $id)->update(['status' => '1']);
        return redirect('/rateio/listar')->withInput(); //redireciona por url
    }


}
