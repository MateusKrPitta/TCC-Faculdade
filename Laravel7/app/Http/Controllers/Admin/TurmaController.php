<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Turma; //Adicionado por Cezar
use App\Matricula; //Adicionado por Cezar
use App\Http\Requests\TurmaRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario;

class TurmaController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        return view('admin.turma.cadastrar')->with('usuario_id', auth()->user()->id);
    }

    public function gravar(TurmaRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Turma::create($dados);
        return redirect('/turma/cadastrar')->withInput();
    }

    public function listar() {
        $turmas = DB::table('turmas')->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->paginate($this->linhasNaPagina);
        $cabecalho = [
            ['label' => 'Turma', 'width' =>10],
            ['label' => 'Ano', 'width' =>5],
            ['label' => 'Período', 'width' =>10],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 3, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.turma.listar', compact('turmas', 'cabecalho', 'config'));
    }

    public function editar() {
        $id = Request::route('id');
        $turma = DB::table('turmas')
                ->where('id', '=', $id)
                ->first();
        return view('admin.turma.editar')
                        ->with('turma', $turma)
                        ->with('usuario_id', auth()->user()->id);
    }

    public function atualizar(TurmaRequest $request) {
        $dados = Request::all();
        $turma = Turma::find($dados['id']);
        $turma->nome = $dados['nome'];
        $turma->ano = $dados['ano'];
        $turma->periodo = $dados['periodo'];

        $turma->observacoes = $dados['observacoes'];
        $turma->usuario_id = $dados['usuario_id'];

        $turma->save();
        return redirect('/turma/listar')->withInput(); //redireciona por url
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $turma = Turma::find($id);
        if($turma) {           
            $turma->delete();
        }
        return redirect('/turma/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('turmas')->where('id', $id)->update(['status' => '0']);
        return redirect('/turma/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('turmas')->where('id', $id)->update(['status' => '1']);
        return redirect('/turma/listar')->withInput(); //redireciona por url
    }

    public function ficha() {
        $id = \Illuminate\Support\Facades\Request::route('id');

        $matriculas = DB::table('matriculas')
                        ->leftJoin('alunos', 'matriculas.aluno_id', '=', 'alunos.id')
                        ->leftJoin('turmas', 'matriculas.turma_id', '=', 'turmas.id')
                        ->select('alunos.id as aluno_id', 'alunos.nome as aluno_nome', 'alunos.status as aluno_status', 'matriculas.id as id', 'matriculas.observacoes as observacoes', 'matriculas.status as status', 'turmas.id as turma_id', 'turmas.nome as turma_nome', 'turmas.ano as turma_ano', 'turmas.periodo as turma_periodo', 'turmas.status as turma_status')
                        ->where('matriculas.status', '1')
                        ->where('matriculas.turma_id', $id)
                        ->orderBy('turma_ano', 'desc')
                        ->orderBy('turma_periodo')
                        ->orderBy('turma_nome')
                        ->orderBy('aluno_nome')
                        ->get()->toArray();

        $turma = Turma::where('turmas.id', $id)->get();
        //dd($turma);
        return view('admin.turma.ficha')->with('turma', $turma)->with('matriculas', $matriculas);
    }

    public static function baixamensal() {
        $ummesatras = Carbon::now('America/Campo_Grande')->addDay(-30); //Pega a data atual e subtrai 30 dias
        return DB::table('turmas')->where('status', 0)->where('updated_at', '>', $ummesatras)->count(); //Busca no banco e conta a quantidade de resultados
    }

    public static function novosmensal() {
        $ummesatras = Carbon::now('America/Campo_Grande')->addDay(-30); //Pega a data atual e subtrai 30 dias
        return DB::table('turmas')->where('status', 1)->where('updated_at', '>', $ummesatras)->count(); //Busca no banco e conta a quantidade de resultados
    }

}
