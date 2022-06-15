<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Aluno; //Adicionado por Cezar
use App\Http\Requests\AlunoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario;

class AlunoController extends Controller {

    private $linhasporpagina = 10;
    private $linhasNaPagina = 7;

    public function cadastrar() {
        return view('admin.aluno.cadastrar')->with('usuario_id', auth()->user()->id);
    }

    public function gravar(AlunoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Aluno::create($dados);
        return redirect('/aluno/cadastrar')->withInput();
    }

    public function listar() {
        $alunos = DB::table('alunos')->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->paginate($this->linhasNaPagina);
        $cabecalho = [
            ['label' => 'Nome', 'with' => 10],
            ['label' => 'Pai', 'with' => 5],
            ['label' => 'Telefone Pai', 'with' => 2],
            ['label' => 'Mãe', 'with' => 5],
            ['label' => 'Telefone Mãe', 'with' => 2],          
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 5, 'no-export' => true],
            
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.aluno.listar', compact('alunos', 'cabecalho', 'config' ));
    }

    public function listarfiltro(Request $request, Aluno $aluno) {
        $dadosFiltro = Request::all();
        $alunos = $aluno->filtro($dadosFiltro, $this->linhasNaPagina);
        return view('admin.aluno.listar', compact('alunos'));
    }

    public function editar() {
        $id = Request::route('id');
        $aluno = DB::table('alunos')
                ->where('id', $id)
                ->first();
        return view('admin.aluno.editar')->with('aluno', $aluno);
    }

    public function atualizar(AlunoRequest $request) {
        $dados = Request::all();
        $aluno = Aluno::find($dados['id']);
        $aluno->nome = $dados['nome'];
        $aluno->sexo = $dados['sexo'];
        $aluno->nascimento = $dados['nascimento'];
        $aluno->cpf = $dados['cpf'];
        $aluno->nomepai = $dados['nomepai'];
        $aluno->numerotelefonepai = $dados['numerotelefonepai'];
        $aluno->nascimentopai = $dados['nascimentopai'];
        $aluno->cpfpai = $dados['cpfpai'];
        $aluno->enderecopai = $dados['enderecopai'];
        $aluno->bairropai = $dados['bairropai'];
        $aluno->cidadepai = $dados['cidadepai'];
        $aluno->estadopai = $dados['estadopai'];
        $aluno->emailpai = $dados['emailpai'];
        $aluno->trabalhopai = $dados['trabalhopai'];
        $aluno->telefonetrabalhopai = $dados['telefonetrabalhopai'];
        $aluno->cargopai = $dados['cargopai'];
        $aluno->horariopai = $dados['horariopai'];
        $aluno->nomemae = $dados['nomemae'];
        $aluno->numerotelefonemae = $dados['numerotelefonemae'];
        $aluno->nascimentomae = $dados['nascimentomae'];
        $aluno->cpfmae = $dados['cpfmae'];
        $aluno->enderecomae = $dados['enderecomae'];
        $aluno->bairromae = $dados['bairromae'];
        $aluno->cidademae = $dados['cidademae'];
        $aluno->estadomae = $dados['estadomae'];
        $aluno->emailmae = $dados['emailmae'];
        $aluno->trabalhomae = $dados['trabalhomae'];
        $aluno->telefonetrabalhomae = $dados['telefonetrabalhomae'];
        $aluno->cargomae = $dados['cargomae'];
        $aluno->horariomae = $dados['horariomae'];
        $aluno->relacaopais = $dados['relacaopais'];
        $aluno->cuidados = $dados['cuidados'];
        $aluno->nomeresponsavel = $dados['nomeresponsavel'];
        $aluno->numerotelefoneresponsavel = $dados['numerotelefoneresponsavel'];
        $aluno->nascimentoresponsavel = $dados['nascimentoresponsavel'];
        $aluno->cpfresponsavel = $dados['cpfresponsavel'];
        $aluno->enderecoresponsavel = $dados['enderecoresponsavel'];
        $aluno->bairroresponsavel = $dados['bairroresponsavel'];
        $aluno->cidaderesponsavel = $dados['cidaderesponsavel'];
        $aluno->estadoresponsavel = $dados['estadoresponsavel'];
        $aluno->emailresponsavel = $dados['emailresponsavel'];
        $aluno->trabalhoresponsavel = $dados['trabalhoresponsavel'];
        $aluno->telefonetrabalhoresponsavel = $dados['telefonetrabalhoresponsavel'];
        $aluno->cargoresponsavel = $dados['cargoresponsavel'];
        $aluno->horarioresponsavel = $dados['horarioresponsavel'];
        $aluno->nomeresponsavelfinanceiro = $dados['nomeresponsavelfinanceiro'];
        $aluno->numerotelefoneresponsavelfinanceiro = $dados['numerotelefoneresponsavelfinanceiro'];
        $aluno->cpfresponsavelfinanceiro = $dados['cpfresponsavelfinanceiro'];
        $aluno->emailresponsavelfinanceiro = $dados['emailresponsavelfinanceiro'];
        $aluno->papinhasalgada = $dados['papinhasalgada'];
        $aluno->papinhadefrutas = $dados['papinhadefrutas'];
        $aluno->suco = $dados['suco'];
        $aluno->outraalimentacao = $dados['outraalimentacao'];
        $aluno->cartaosus = $dados['cartaosus'];
        $aluno->planodesaude = $dados['planodesaude'];
        $aluno->nomeplanodesaude = $dados['nomeplanodesaude'];
        $aluno->medicamentos = $dados['medicamentos'];
        $aluno->nomemedicamentos = $dados['nomemedicamentos'];
        $aluno->alergia = $dados['alergia'];
        $aluno->nomealergia = $dados['nomealergia'];
        $aluno->alergiaalimento = $dados['alergiaalimento'];
        $aluno->nomealergiaalimento = $dados['nomealergiaalimento'];
        $aluno->problemasaude = $dados['problemasaude'];
        $aluno->nomeproblemasaude = $dados['nomeproblemasaude'];
        $aluno->necessidadesfisicas = $dados['necessidadesfisicas'];
        $aluno->nomenecessidadesfisicas = $dados['nomenecessidadesfisicas'];
        $aluno->oculos = $dados['oculos'];
        $aluno->anemia = $dados['anemia'];
        $aluno->diabetes = $dados['diabetes'];
        $aluno->lactose = $dados['lactose'];
        $aluno->refluxo = $dados['refluxo'];
        $aluno->gluten = $dados['gluten'];
        $aluno->tiposanguineo = $dados['tiposanguineo'];
        $aluno->peso = $dados['peso'];
        $aluno->altura = $dados['altura'];
        $aluno->autorizabuscaraluno = $dados['autorizabuscaraluno'];
        $aluno->autorizabuscaralunonome = $dados['autorizabuscaralunonome'];
        $aluno->observacoes = $dados['observacoes'];
        $aluno->usuario_id = \Illuminate\Support\Facades\Auth::user()->id;
        $aluno->save();
        return redirect('/aluno/listar')->withInput(); //redireciona por url
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $aluno = Aluno::find($id);
        if($aluno) {           
            $aluno->delete();
        }
        return redirect('/aluno/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('alunos')->where('id', $id)->update(['status' => '0']);
        return redirect('/aluno/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('alunos')->where('id', $id)->update(['status' => '1']);
        return redirect('/aluno/listar')->withInput(); //redireciona por url
    }

    public function ficha() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $aluno = Aluno::where('alunos.id', $id)->get();
        //dd($aluno);
        return view('admin.aluno.ficha')->with('aluno', $aluno);
    }

    public static function baixamensal() {
        $ummesatras = Carbon::now('America/Campo_Grande')->addDay(-30); //Pega a data atual e subtrai 30 dias
        return DB::table('alunos')->where('status', 0)->where('updated_at', '>', $ummesatras)->count(); //Busca no banco e conta a quantidade de resultados
    }

    public static function novosmensal() {
        $ummesatras = Carbon::now('America/Campo_Grande')->addDay(-30); //Pega a data atual e subtrai 30 dias
        return DB::table('alunos')->where('status', 1)->where('updated_at', '>', $ummesatras)->count(); //Busca no banco e conta a quantidade de resultados
    }

}
