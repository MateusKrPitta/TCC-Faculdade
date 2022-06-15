<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Quota; //Adicionado por Cezar
use App\Http\Requests\QuotaRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar

class QuotaController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        return view('admin.home.emdesenvolvimento');
        return view('admin.quota.cadastrar');
    }

    public function gravar(QuotaRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Quota::create($dados);
        return redirect('/quota/cadastrar')->withInput();
    }

    public function editar() {
        return view('admin.home.emdesenvolvimento');
        $id = Request::route('id');
        $quota = DB::select('select * from quotas where id = ?', [$id]);
        return view('admin.quota.editar')->with('quota', $quota);
    }

    public function atualizar() {
        $dados = Request::all();
        $quota = Quota::find($dados['id']);
        $quota->nome = $dados['nome'];
        $quota->parcela = $dados['parcela'];
        $quota->planodecontas_id = $dados['planodecontas_id'];
        $quota->status = $dados['status'];
        $quota->save();
        return redirect('/quota/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        return view('admin.home.emdesenvolvimento');
        $quotas = DB::table('quotas')->orderBy('nome')
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
        return view('admin.quota.listar', compact('quotas', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $quota = Quota::find($id);
        if($quota) {           
            $quota->delete();
        }
        return redirect('/quota/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('quotas')->where('id', $id)->update(['status' => '0']);
        return redirect('/quota/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('quotas')->where('id', $id)->update(['status' => '1']);
        return redirect('/quota/listar')->withInput(); //redireciona por url
    }


}
