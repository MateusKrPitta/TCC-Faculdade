<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\OrdemdeServico; //Adicionado por Cezar
use App\Http\Requests\OrcamentoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use App\Servico;
use App\Sistemalog;

class OrdemdeServicoController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        $clientes = DB::table('clientes')->where('empresa_id', Usuario::empresa())->get();
        $orcamentos = DB::table('orcamentos')->where('empresa_id', Usuario::empresa())->get();
        return view('admin.ordemdeservico.cadastrar')->with('clientes', $clientes)->with('orcamentos', $orcamentos);
    }

    public function gravar() {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        OrdemdeServico::create($dados);
        return redirect('/ordemdeservico/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $clientes = DB::select('select * from clientes where id = ?', [$id]);
        $orcamentos = DB::select('select * from orcamentos where id = ?', [$id]);
        $ordemdeservico = DB::select('select * from medicos where id = ?', [$id]);
        // $ordemdeservicos = DB::select('select * from ordemdeservicos where id = ?', [$id]);
        return view('admin.ordemdeservico.editar')->with('ordemdeservico', $ordemdeservico)->with('orcamentos', $orcamentos)->with('clientes', $clientes);
    }

    public function atualizar() {
        $dados = Request::all();
        $ordemdeservicos = Orcamento::find($dados['id']);
        $ordemdeservicos->nome = $dados['nome'];
        $ordemdeservicos->cpfcnpj = $dados['cpfcnpj'];
        $ordemdeservicos->rgie = $dados['rgie'];
        $ordemdeservicos->nascimento = $dados['nascimento'];
        $ordemdeservicos->save();
        return redirect('/ordemdeservicos/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        //$orcamento = Orcamento::all()->sortBy('nome')->where('empresa_id', Usuario::empresa());
        //return view('admin.orcamento.listar')->with('orcamento', $orcamento);

        $ordemdeservicos = DB::table('ordemdeservicos')
                ->where('ordemdeservicos.empresa_id', Usuario::empresa())
                ->leftJoin('clientes', 'ordemdeservicos.cliente_id', '=', 'clientes.id')
                ->leftJoin('orcamentos', 'ordemdeservicos.orcamento_id', '=', 'orcamentos.id')
                ->select('ordemdeservicos.id as id',
                        'clientes.nome as clientes_nome',
                        'orcamentos.id as orcamento_id',
                        'ordemdeservicos.valor as valor',
                        'ordemdeservicos.status as status')
                ->get();
        $cabecalho = [
            ['label' => 'Ordem de Serviço', 'width' => 10],
            ['label' => 'Serviço', 'width' => 10],
            ['label' => 'Cliente', 'width' => 10],
            ['label' => 'Valor', 'width' => 10],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 3, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.ordemdeservico.listar', compact('ordemdeservicos', 'cabecalho', 'config'));
    }

    public function listarfiltro(Request $request, OrdemdeServicoServico $ordemdeservico) {
        //dd(Request::all());
        $dadosFiltro = Request::all();
        $ordemdeservicos = $ordemdeservico->filtro($dadosFiltro, $this->linhasNaPagina);
        return view('admin.ordemdeservico.listar', compact('ordemdeservicos'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $ordemdeservicos = Orcamento::find($id);
        if ($ordemdeservicos) {
            $ordemdeservicos->delete();
        }
        return redirect('/$ordemdeservico/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('$ordemdeservicos')->where('id', $id)->update(['status' => '0']);
        return redirect('/$ordemdeservico/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('orcamentodeservicos')->where('id', $id)->update(['status' => '1']);
        return redirect('/orcamentodeservico/listar')->withInput(); //redireciona por url
    }

    public static function baixamensal() {
        $ummesatras = Carbon::now('America/Campo_Grande')->addDay(-30); //Pega a data atual e subtrai 30 dias
        return DB::table('$ordemdeservico')->where('status', 0)->where('updated_at', '>', $ummesatras)->count(); //Busca no banco e conta a quantidade de resultados
    }

}
