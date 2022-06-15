<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Cliente;
use App\Http\Controllers\Controller;
use App\Orcamento; //Adicionado por Cezar
use App\Http\Requests\OrcamentoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar

class OrcamentoController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        $clientes = Cliente::all()->where('empresa_id', Usuario::empresa());
        return view('admin.orcamento.cadastrar')->with('clientes', $clientes);
    }

    public function gravar(OrcamentoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Orcamento::create($dados);
        return redirect('/orcamento/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $orcamentos = DB::select('select * from orcamentos where id = ?', [$id]);
        $clientes = DB::select('select * from clientes where id = ?', [$id]);
        return view('admin.orcamento.editar')->with('orcamentos', $orcamentos)->with('clientes', $clientes);
    }

    public function atualizar() {
        $dados = Request::all();
        $orcamento = Orcamento::find($dados['id']);
        $orcamento->nome = $dados['nome'];
        $orcamento->cpfcnpj = $dados['cpfcnpj'];
        $orcamento->rgie = $dados['rgie'];
        $orcamento->nascimento = $dados['nascimento'];
        $orcamento->tel1 = $dados['tel1'];
        $orcamento->tel2 = $dados['tel2'];
        $orcamento->sexo = $dados['sexo'];
        $orcamento->logradouro = $dados['logradouro'];
        $orcamento->numero = $dados['numero'];
        $orcamento->bairro = $dados['bairro'];
        $orcamento->cidade = $dados['cidade'];
        $orcamento->estado = $dados['estado'];
        $orcamento->status = $dados['status'];
        $orcamento->save();
        return redirect('/orcamento/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        //$orcamento = Orcamento::all()->sortBy('nome')->where('empresa_id', Usuario::empresa());
        //return view('admin.orcamento.listar')->with('orcamento', $orcamento);
        $orcamentos = DB::table('orcamentos')
                ->where('orcamentos.empresa_id', Usuario::empresa())
                ->leftJoin('clientes', 'orcamentos.cliente_id', '=', 'clientes.id')
                ->select('orcamentos.id as id',
                        'clientes.nome as cliente_nome',
                        'orcamentos.data as data',
                        'orcamentos.status as status')
                ->get();
        $cabecalho = [
            ['label' => 'Nome', 'widft' => 10],
            ['label' => 'Data', 'widft' => 3],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 10, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.orcamento.listar', compact('orcamentos', 'cabecalho', 'config'));
    }

    public function listarfiltro(Request $request, Orcamento $orcamento) {
        //dd(Request::all());
        $dadosFiltro = Request::all();
        $orcamentos = $orcamento->filtro($dadosFiltro, $this->linhasNaPagina);
        return view('admin.orcamento.listar', compact('orcamentos'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $orcamento = Orcamento::find($id);
        if ($orcamento) {
            $orcamento->delete();
        }
        return redirect('/orcamento/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('orcamentos')->where('id', $id)->update(['status' => '0']);
        return redirect('/orcamento/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('orcamentos')->where('id', $id)->update(['status' => '1']);
        return redirect('/orcamento/listar')->withInput(); //redireciona por url
    }

    public static function baixamensal() {
        $ummesatras = Carbon::now('America/Campo_Grande')->addDay(-30); //Pega a data atual e subtrai 30 dias
        return DB::table('orcamentos')->where('status', 0)->where('updated_at', '>', $ummesatras)->count(); //Busca no banco e conta a quantidade de resultados
    }

}
