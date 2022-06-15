<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Especialidade; //Adicionado por Cezar
use App\Http\Requests\EspecialidadeRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use App\Sistemalog;

class EspecialidadeController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        return view('admin.especialidade.cadastrar');
    }

    public function gravar() {
        $dados = Request::all(); /// pegas todas as informações para transferir para o banco
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Especialidade::create($dados); /// comando que salva no banco de dados
        return redirect('/especialidade/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $especialidades = DB::select('select * from especialidades where id = ?', [$id]);
        return view('admin.especialidade.editar')->with('especialidades', $especialidades);
    }

    public function atualizar() {
        $dados = Request::all();
        $especialidades = Exame::find($dados['id']);
        $especialidades->nome = $dados['nome_especialidade'];
        $especialidades->conselhoregional = $dados['conselhoregional '];
        $especialidades->valor_referencia = $dados['valor_referencia'];
        $especialidades->status = $dados['status'];
        $especialidades->observacao = $dados['usuario_id'];
        $especialidades->save();
        return redirect('/especialidade/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $especialidades = DB::table('especialidades')->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->paginate($this->linhasNaPagina);
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Conselho Regional', 'width' => 20],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 3, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, ['orderable' => false], ['orderable' => false]],
        ];

        return view('admin.especialidade.listar', compact('especialidades', 'cabecalho', 'config'));
    }

    public function listarfiltro(Request $request, Especialidade $especialidades) {
        //dd(Request::all());
        $dadosFiltro = Request::all();
        $especialidades = $especialidades->filtro($dadosFiltro, $this->linhasNaPagina);
        return view('admin.especialidade.listar', compact('especialidades'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $especialidades = Exame::find($id);
        if ($especialidades) {
            $especialidades->delete();
        }
        return redirect('/especialidade/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('especialidades')->where('id', $id)->update(['status' => '0']);
        return redirect('/especialidade/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('especialidades')->where('id', $id)->update(['status' => '1']);
        return redirect('/especialidade/listar')->withInput(); //redireciona por url
    }

}
