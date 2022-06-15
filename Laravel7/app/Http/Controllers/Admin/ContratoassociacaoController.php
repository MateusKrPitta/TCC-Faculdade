<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Contratoassociacao; //Adicionado por Cezar
use App\Http\Requests\ContratoassociacaoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use App\Cliente;
use App\Veiculo;

class ContratoassociacaoController extends Controller {

    public function cadastrar() {
        $clientes = Cliente::where('empresa_id', Usuario::empresa())->orderBy('nome')->get();
        $veiculos = Veiculo::where('empresa_id', Usuario::empresa())->get();
        return view('admin.home.emdesenvolvimento')->with('clientes', $clientes)->with('veiculos', $veiculos);
    }

    public function gravar(ContratoassociacaoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        $dados['valor'] = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor
        Contratoassociacao::create($dados);
        return redirect('/contratoassociacao/cadastrar')->withInput();
    }

    public function editar() {
        $clientes = Cliente::where('empresa_id', Usuario::empresa())->orderBy('nome')->get();
        $veiculos = Veiculo::where('empresa_id', Usuario::empresa())->get();
        $id = Request::route('id');
        $contratoassociacao = DB::select('select * from contratoassociacaos where id = ?', [$id]);
        return view('admin.home.emdesenvolvimento')->with('clientes', $clientes)->with('veiculos', $veiculos)->with('contratoassociacao', $contratoassociacao);
    }

    public function atualizar(ContratoassociacaoRequest $request) {
        $dados = Request::all();
        $contratoassociacao = Contratoassociacao::find($dados['id']);
        $contratoassociacao->cliente_id = $dados['cliente_id'];
        $contratoassociacao->veiculo_id = $dados['veiculo_id'];
        $contratoassociacao->itinerario = $dados['itinerario'];
        $contratoassociacao->valor = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor
        $contratoassociacao->localembarqueinicio = $dados['localembarqueinicio'];
        $contratoassociacao->datainicio = $dados['datainicio'];
        $contratoassociacao->horainicio = $dados['horainicio'];
        $contratoassociacao->localdedestino = $dados['localdedestino'];
        $contratoassociacao->localembarqueretorno = $dados['localembarqueretorno'];
        $contratoassociacao->dataretorno = $dados['dataretorno'];
        $contratoassociacao->horaretorno = $dados['horaretorno'];
        //$contratoassociacao->observacao = $dados['observacao'];
        $contratoassociacao->datadocontrato = $dados['datadocontrato'];
        //$contratoassociacao->status = $dados['status'];
        $contratoassociacao->save();
        return redirect('/contratoassociacao/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $contratoassociacao = DB::table('contratoassociacaos')
                ->orderBy('contratoassociacaos.data')
                ->where('contratoassociacaos.empresa_id', '=', Usuario::empresa())
                ->leftJoin('clientes', 'contratoassociacaos.cliente_id', '=', 'clientes.id')
                ->select('contratoassociacaos.id as id',
                        'contratoassociacaos.empresa_id as empresa_id',
                        'contratoassociacaos.cliente_id as cliente_id',
                        'contratoassociacaos.veiculo_id1 as veiculo_id1',
                        'contratoassociacaos.veiculo_id2 as veiculo_id2',
                        'contratoassociacaos.veiculo_id3 as veiculo_id3',
                        'contratoassociacaos.veiculo_id4 as veiculo_id4',
                        'contratoassociacaos.data as data',
                        'contratoassociacaos.termo_id as termo_id',
                        'contratoassociacaos.valormensalidade as valormensalidade',
                        'contratoassociacaos.valorfundocaixa as valorfundocaixa',
                        'contratoassociacaos.valortotal as valortotal',
                        'contratoassociacaos.valorterceiro as valorterceiro',
                        'contratoassociacaos.nome as nome',
                        'contratoassociacaos.formadepagamento_id as formadepagamento_id',
                        'contratoassociacaos.observacao as observacao',
                        'contratoassociacaos.status as status',
                        'clientes.nome as cliente_nome',
                        'clientes.cpfcnpj as cliente_cpf',
                        'clientes.rgie as cliente_rg',
                        'clientes.nascimento as cliente_nascimento',
                        'clientes.tel1 as cliente_tel1',
                        'clientes.sexo as cliente_sexo',
                        'clientes.cidade as cliente_cidade',
                        'clientes.estado as cliente_estado',
                        'clientes.status as cliente_status')
                ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Cliente', 'width' => 10],
            ['label' => 'Observação', 'width' => 10],
            ['label' => 'Data', 'width' => 1],
            ['label' => 'Valor', 'width' => 1],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 2, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.contratoassociacao.listar', compact('contratoassociacao', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $contratoassociacao = Contratoassociacao::find($id);
        if($contratoassociacao) {           
            $contratoassociacao->delete();
        }
        return redirect('/contratoassociacao/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('contratoassociacaos')->where('id', $id)->update(['status' => '0']);
        return redirect('/contratoassociacao/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('contratoassociacaos')->where('id', $id)->update(['status' => '1']);
        return redirect('/contratoassociacao/listar')->withInput(); //redireciona por url
    }
    
    public function imprimircontrato() {
        $id = Request::route('id');
        $contratoassociacao = DB::table('contratoassociacaos')
                ->orderBy('contratoassociacaos.datadocontrato')
                ->where('contratoassociacaos.id', '=', $id)
                ->leftJoin('veiculos', 'contratoassociacaos.veiculo_id', '=', 'veiculos.id')
                ->leftJoin('clientes', 'contratoassociacaos.cliente_id', '=', 'clientes.id')
                ->select('contratoassociacaos.id as id',
                        'contratoassociacaos.empresa_id as empresa_id',
                        'contratoassociacaos.veiculo_id as veiculo_id',
                        'contratoassociacaos.cliente_id as cliente_id',
                        'contratoassociacaos.datadocontrato as datadocontrato',
                        'contratoassociacaos.localdedestino as localdedestino',
                        'contratoassociacaos.itinerario as itinerario',
                        'contratoassociacaos.valor as valor',
                        'contratoassociacaos.localdedestino as localdedestino',
                        'contratoassociacaos.localembarqueinicio as localembarqueinicio',
                        'contratoassociacaos.datainicio as datainicio',
                        'contratoassociacaos.horainicio as horainicio',
                        'contratoassociacaos.localembarqueretorno as localembarqueretorno',
                        'contratoassociacaos.dataretorno as dataretorno',
                        'contratoassociacaos.horaretorno as horaretorno',
                        'contratoassociacaos.status as status',
                        'clientes.nome as cliente_nome',
                        'clientes.cpfcnpj as cliente_cpf',
                        'clientes.rgie as cliente_rg',
                        'clientes.nascimento as cliente_nascimento',
                        'clientes.tel1 as cliente_tel1',
                        'clientes.sexo as cliente_sexo',
                        'clientes.logradouro as cliente_endereco',
                        'clientes.numero as cliente_numero',
                        'clientes.bairro as cliente_bairro',
                        'clientes.cidade as cliente_cidade',
                        'clientes.estado as cliente_estado',
                        'clientes.status as cliente_status',
                        'veiculos.nome as veiculo_nome',
                        'veiculos.marcamodelo as marcamodelo',
                        'veiculos.placa as placa',
                        'veiculos.acentos as acentos',
                        'veiculos.status as veiculo_status')
                ->get();
        return view('admin.home.emdesenvolvimento')->with('contratoassociacao', $contratoassociacao);
    }

}
