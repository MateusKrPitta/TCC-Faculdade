<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Carne; //Adicionado por Cezar
use App\Http\Requests\CarneRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar

class CarneController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        return view('admin.home.emdesenvolvimento');
        return view('admin.carne.cadastrar');
    }

    public function gravar(CarneRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Carne::create($dados);
        return redirect('/carne/cadastrar')->withInput();
    }

    public function editar() {
        return view('admin.home.emdesenvolvimento');
        $id = Request::route('id');
        $carne = DB::select('select * from carnes where id = ?', [$id]);
        return view('admin.carne.editar')->with('carne', $carne);
    }

    public function atualizar() {
        $dados = Request::all();
        $carne = Carne::find($dados['id']);
        $carne->nome = $dados['nome'];
        $carne->parcela = $dados['parcela'];
        $carne->planodecontas_id = $dados['planodecontas_id'];
        $carne->status = $dados['status'];
        $carne->save();
        return redirect('/carne/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        return view('admin.home.emdesenvolvimento');
        $carnes = DB::table('carnes')->orderBy('nome')
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
        return view('admin.carne.listar', compact('carnes', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $carne = Carne::find($id);
        if($carne) {           
            $carne->delete();
        }
        return redirect('/carne/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('carnes')->where('id', $id)->update(['status' => '0']);
        return redirect('/carne/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('carnes')->where('id', $id)->update(['status' => '1']);
        return redirect('/carne/listar')->withInput(); //redireciona por url
    }


}
