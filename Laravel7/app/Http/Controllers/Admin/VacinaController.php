<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Vacina; //Adicionado por Cezar
use App\Http\Requests\VacinaRequest; //Adicionado por Cezar
use App\Usuario;

class VacinaController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        return view('admin.vacina.cadastrar')->with('usuario_id', auth()->user()->id);
    }

    public function vacinargrupo() {
        return view('admin.vacina.cadastrargrupo')->with('usuario_id', auth()->user()->id);
    }

    public function gravar(VacinaRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Vacina::create($dados);
        return redirect('/vacina/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $vacina = DB::select('select * from vacinas where id = ?', [$id]);
        return view('admin.vacina.editar')->with('vacina', $vacina);
    }

    public function atualizar(VacinaRequest $request) {
        $dados = Request::all();
        DB::table('vacinas')->where('id', $dados['id'])->update([
            'nome' => $dados['nome'],
            'numero' => $dados['numero'],
            'pai' => $dados['pai'],
            'mae' => $dados['mae'],
            'peso' => $dados['peso']
        ]);
        return redirect('/vacina/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $vacina = Vacina::all()->sort();
        $cabecalho = [
            ['label' => 'Vacina', 'width' => 10],
            ['label' => 'Sexo', 'width' => 10],
            ['label' => 'Data de Início', 'width' => 5],
            ['label' => 'Data de Fim', 'width' => 5],
            ['label' => 'Tipo', 'width' => 10],
            ['label' => 'Intervalor', 'width' => 5],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 3, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.vacina.listar', compact('vacina', 'cabecalho', 'config'));
    }

    public function listarfiltro(Request $request, Vacina $vacina) {
        $dadosFiltro = Request::all();
        $vacinas = $vacina->filtro($dadosFiltro, $this->linhasNaPagina);
        return view('admin.vacina.listar', compact('vacinas'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $vacina = Vacina::find($id);
        if ($vacina) {
            $vacina->delete();
        }
        return redirect('/vacina/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('vacinas')->where('id', $id)->update(['status' => '0']);
        return redirect('/vacina/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('vacinas')->where('id', $id)->update(['status' => '1']);
        return redirect('/vacina/listar')->withInput(); //redireciona por url
    }

}
