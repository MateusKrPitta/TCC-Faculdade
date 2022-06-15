<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Boleto; //Adicionado por Cezar
use App\Http\Requests\BoletoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar

class BoletoController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        return view('admin.home.emdesenvolvimento');
        return view('admin.boleto.cadastrar');
    }

    public function gravar(BoletoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Boleto::create($dados);
        return redirect('/boleto/cadastrar')->withInput();
    }

    public function editar() {
        return view('admin.home.emdesenvolvimento');
        $id = Request::route('id');
        $boleto = DB::select('select * from boletos where id = ?', [$id]);
        return view('admin.boleto.editar')->with('boleto', $boleto);
    }

    public function atualizar() {
        $dados = Request::all();
        $boleto = Boleto::find($dados['id']);
        $boleto->nome = $dados['nome'];
        $boleto->parcela = $dados['parcela'];
        $boleto->planodecontas_id = $dados['planodecontas_id'];
        $boleto->status = $dados['status'];
        $boleto->save();
        return redirect('/boleto/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        return view('admin.home.emdesenvolvimento');
        $boletos = DB::table('boletos')->orderBy('nome')
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
        return view('admin.boleto.listar', compact('boletos', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $boleto = Boleto::find($id);
        if($boleto) {           
            $boleto->delete();
        }
        return redirect('/boleto/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('boletos')->where('id', $id)->update(['status' => '0']);
        return redirect('/boleto/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('boletos')->where('id', $id)->update(['status' => '1']);
        return redirect('/boleto/listar')->withInput(); //redireciona por url
    }


}
