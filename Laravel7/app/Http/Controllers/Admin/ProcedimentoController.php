<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Procedimento; //Adicionado por Cezar
use App\Http\Requests\MedicoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use App\Sistemalog;
use App\Especialidade;
use App\Http\Requests\ProcedimentoRequest;

class ProcedimentoController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        $especialidades = DB::table('especialidades')->where('empresa_id', Usuario::empresa())->get();
        return view('admin.procedimento.cadastrar')->with('especialidades', $especialidades);
    }

    public function gravar(ProcedimentoRequest $request) {

        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Procedimento::create($dados); /// comando que salva no banco de dados
        return redirect('/procedimento/cadastrar')->withInput();
    }

    public function editar() {
        $especialidades = DB::table('especialidades')->where('empresa_id', Usuario::empresa())->get();
        $id = Request::route('id');
        $procedimentos = DB::select('select * from procedimentos where id = ?', [$id]);
        return view('admin.procedimento.editar')->with('procedimentos', $procedimentos)->with('especialidades', $especialidades);
    }

    public function listar() {
        $procedimentos = DB::table('procedimentos')
                ->where('procedimentos.empresa_id', Usuario::empresa())
                ->leftJoin('especialidades', 'procedimentos.especialidade_id', '=', 'especialidades.id')
                ->select('procedimentos.id as id',
                        'procedimentos.nome as nome',
                        'procedimentos.tempo as tempo',
                        'procedimentos.valor as valor',
                        'especialidades.nome as nome_especialidade',
                        'procedimentos.status as status')
                ->get();
        $cabecalho = [
            ['label' => 'Procedimento', 'width' => 10],
            ['label' => 'Especialidade', 'width' => 10],
            ['label' => 'Tempo', 'width' => 5],
            ['label' => 'Valor', 'width' => 5],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 2, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        
        //dd($medicos);
        return view('admin.procedimento.listar', compact('procedimentos', 'cabecalho', 'config'));
    }

    public function listarfiltro(Request $request, Procedimento $procedimento) {
        $dadosFiltro = Request::all();
        $procedimentos = $procedimento->filtro($dadosFiltro, $this->linhasNaPagina);
        return view('admin.procedimento.listar', compact('procedimentos'));
    }

    public function atualizar(ProcedimentoRequest $request) {
        $dados = Request::all();
        $procedimentos = Procedimento::find($dados['id']);
        $procedimentos->nome = $dados['nome'];
        $procedimentos->tempo = $dados['tempo'];
        $procedimentos->valor = $dados['valor'];
        $procedimentos->usuario_id = $dados['usuario_id'];
        $procedimentos->status = $dados['status'];
        $procedimentos->save();
        return redirect('/procedimento/listar')->withInput(); //redireciona por url
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $procedimentos = Procedimento::find($id);
        if ($procedimentos) {
            $procedimentos->delete();
        }
        return redirect('/procedimento/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('procedimentos')->where('id', $id)->update(['status' => '0']);
        return redirect('/procedimento/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('procedimentos')->where('id', $id)->update(['status' => '1']);
        return redirect('/procedimento/listar')->withInput(); //redireciona por url
    }

}
