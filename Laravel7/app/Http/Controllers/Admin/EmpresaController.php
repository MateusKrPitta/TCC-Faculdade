<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Empresa; //Adicionado por Cezar
use App\Http\Requests\EmpresaRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo

class EmpresaController extends Controller {

    public function cadastrar() {
        return view('admin.empresa.cadastrar');
    }

    public function gravar(EmpresaRequest $request) {
        Empresa::create($request->all());
        return redirect('/empresa/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $empresa = DB::select('select * from empresas where id = ?', [$id]);
        return view('admin.empresa.editar')->with('empresa', $empresa);
    }

    public function atualizar() {
        $dados = Request::all();
        $empresa = Empresa::find($dados['id']);
        $empresa->nome = $dados['nome'];
        $empresa->razaosocial = $dados['razaosocial'];
        $empresa->cpfcnpj = $dados['cpfcnpj'];
        $empresa->rgie = $dados['rgie'];
        $empresa->save();
        return redirect('/empresa/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $empresas = DB::table('empresas')->get();

        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Razão Social', 'width' => 10],
            ['label' => 'CNPJ', 'width' => 3],
            ['label' => 'Inscrição Estadual', 'width' => 3],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 1, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.empresa.listar', compact('empresas', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $empresa = Empresa::find($id);
        if ($empresa) {
            $empresa->delete();
        }
        return redirect('/empresa/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('empresas')->where('id', $id)->update(['status' => '0']);
        return redirect('/empresa/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('empresas')->where('id', $id)->update(['status' => '1']);
        return redirect('/empresa/listar')->withInput(); //redireciona por url
    }

}
