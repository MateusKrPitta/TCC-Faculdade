<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Matricula; //Adicionado por Cezar
use App\Aluno; //Adicionado por Cezar
use App\Turma; //Adicionado por Cezar
use App\Http\Requests\MatriculaRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario;

class MatriculaController extends Controller {

    private $linhasporpagina = 10;

    public function cadastrar() {
        $turmas = Turma::all()->sortBy('periodo')->sortBy('nome');
        $alunos = Aluno::all()->sortBy('nome');
        return view('admin.matricula.cadastrar')->with('id_usuario', auth()->user()->id)->with('turmas', $turmas)->with('alunos', $alunos);
    }

    public function gravar(MatriculaRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Matricula::create($dados);
        return redirect('/matricula/cadastrar')->withInput();

    }

    public function listar() {
        $turmas = Turma::all()->sortBy('periodo')->sortBy('nome');
        $alunos = Aluno::all()->sortBy('nome');
        $matricula = Matricula::all()->sortBy('turma_id');
        $matriculas = DB::table('matriculas')
                ->leftJoin('alunos', 'matriculas.aluno_id', '=', 'alunos.id')
                ->leftJoin('turmas', 'matriculas.turma_id', '=', 'turmas.id')
                ->select('alunos.id as aluno_id', 'alunos.nome as aluno_nome', 'alunos.status as aluno_status', 'matriculas.id as id', 'matriculas.observacoes as observacoes', 'matriculas.status as status', 'turmas.id as turma_id', 'turmas.nome as turma_nome', 'turmas.ano as turma_ano', 'turmas.periodo as turma_periodo', 'turmas.status as turma_status')
                ->where('matriculas.status', '1')
                ->orderBy('turma_ano', 'desc')
                ->orderBy('turma_periodo')
                ->orderBy('turma_nome')
                ->orderBy('aluno_nome')
                ->paginate($this->linhasporpagina);
        
        $cabecalho = [
            ['label' => 'Nome', 'with' => 10],
            ['label' => 'Turma', 'with' => 10],
            ['label' => 'Ano - Período', 'with' => 5],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 1, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null,['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.matricula.listar', compact('matriculas', 'cabecalho', 'config', 'turmas', 'alunos'));
    }

    public function editar() {

        $turmas = Turma::all()->sortBy('periodo')->sortBy('nome');
        $alunos = Aluno::all()->sortBy('nome');
        $id = Request::route('id');
        $matricula = DB::select('select * from matriculas where id = ?', [$id]);
        return view('admin.matricula.editar')->with('matricula', $matricula)->with('usuario_id', auth()->user()->id)->with('turmas', $turmas)->with('alunos', $alunos);
    }

    public function atualizar(MatriculaRequest $request) {
        $dados = Request::all();
        $matricula = Matricula::find($dados['id']);
        $matricula->aluno_id = $dados['aluno_id'];
        $matricula->turma_id = $dados['turma_id'];
        $matricula->valor_matricula = $dados['valor_matricula'];
        $matricula->valor_mensalidade = $dados['valor_mensalidade'];

        $matricula->observacoes = $dados['observacoes'];
        $matricula->usuario_id = \Illuminate\Support\Facades\Auth::user()->id;
        $matricula->save();
        return redirect('/matricula/listar')->withInput(); //redireciona por url
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $matricula = Matricula::find($id);
        if($matricula) {           
            $matricula->delete();
        }
        return redirect('/matricula/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('matriculas')->where('id', $id)->update(['status' => '0']);
        return redirect('/matricula/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('matriculas')->where('id', $id)->update(['status' => '1']);
        return redirect('/matricula/listar')->withInput(); //redireciona por url
    }

    public function ficha() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $matricula = Matricula::where('matriculas.id', $id)->get();
        //dd($matricula);
        return view('admin.matricula.ficha')->with('matricula', $matricula);
    }

    public static function baixamensal() {
        $ummesatras = Carbon::now('America/Campo_Grande')->addDay(-30); //Pega a data atual e subtrai 30 dias
        return DB::table('matriculas')->where('status', 0)->where('updated_at', '>', $ummesatras)->count(); //Busca no banco e conta a quantidade de resultados
    }

    public static function novosmensal() {
        $ummesatras = Carbon::now('America/Campo_Grande')->addDay(-30); //Pega a data atual e subtrai 30 dias
        return DB::table('matriculas')->where('status', 1)->where('updated_at', '>', $ummesatras)->count(); //Busca no banco e conta a quantidade de resultados
    }

}
