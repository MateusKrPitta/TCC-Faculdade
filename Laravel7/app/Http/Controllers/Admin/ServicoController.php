<?php

namespace App\Http\Controllers\Admin;

use App\Servico;
use \App\Http\Requests\ServicoRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use App\Usuario;
use App\Http\Controllers\Controller;

class ServicoController extends Controller {

    public function cadastrar() {
        return view('admin.servico.cadastrar');
    }

    public function gravar(ServicoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Servico::create($dados);
        return redirect('/servico/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $servico = DB::select('select * from servicos where id = ?', [$id]);
        return view('admin.servico.editar')->with('servico', $servico);
    }

    public function atualizar() {
        $dados = Request::all();
        $servico = Servico::find($dados['id']);
        $servico->nome = $dados['nome'];
        $servico->tempo = $dados['tempo'];
        $servico->valor = $dados['valor'];
        $servico->save();
        return redirect('/servico/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $servico = Servico::all()->sort();
        $cabecalho = [
            ['label' => 'Serviço', 'width' => 10],
            ['label' => 'Tempo', 'width' => 5],
            ['label' => 'Valor', 'width' => 5],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 3, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.servico.listar', compact('servico', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $servico = Servico::find($id);
        if ($servico) {
            $servico->delete();
        }
        return redirect('/servico/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('servicos')->where('id', $id)->update(['status' => '0']);
        return redirect('/servico/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('servicos')->where('id', $id)->update(['status' => '1']);
        return redirect('/servico/listar')->withInput(); //redireciona por url
    }

}
