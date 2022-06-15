<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Contratoviagem; //Adicionado por Cezar
use App\Http\Requests\ContratoviagemRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use App\Cliente;
use App\Veiculo;

class ContratoviagemController extends Controller {

    public function cadastrar() {
        $clientes = Cliente::where('empresa_id', Usuario::empresa())->orderBy('nome')->get();
        $veiculos = Veiculo::where('empresa_id', Usuario::empresa())->get();
        return view('admin.contratoviagem.cadastrar')->with('clientes', $clientes)->with('veiculos', $veiculos);
    }

    public function gravar(ContratoviagemRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        $dados['valor'] = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor
        Contratoviagem::create($dados);
        return redirect('/contratoviagem/cadastrar')->withInput();
    }

    public function editar() {
        $clientes = Cliente::where('empresa_id', Usuario::empresa())->orderBy('nome')->get();
        $veiculos = Veiculo::where('empresa_id', Usuario::empresa())->get();
        $id = Request::route('id');
        $contratoviagem = DB::select('select * from contratoviagems where id = ?', [$id]);
        return view('admin.contratoviagem.editar')->with('clientes', $clientes)->with('veiculos', $veiculos)->with('contratoviagem', $contratoviagem);
    }

    public function atualizar(ContratoviagemRequest $request) {
        $dados = Request::all();
        $contratoviagem = Contratoviagem::find($dados['id']);
        $contratoviagem->cliente_id = $dados['cliente_id'];
        $contratoviagem->veiculo_id = $dados['veiculo_id'];
        $contratoviagem->itinerario = $dados['itinerario'];
        $contratoviagem->valor = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor
        $contratoviagem->localembarqueinicio = $dados['localembarqueinicio'];
        $contratoviagem->datainicio = $dados['datainicio'];
        $contratoviagem->horainicio = $dados['horainicio'];
        $contratoviagem->localdedestino = $dados['localdedestino'];
        $contratoviagem->localembarqueretorno = $dados['localembarqueretorno'];
        $contratoviagem->dataretorno = $dados['dataretorno'];
        $contratoviagem->horaretorno = $dados['horaretorno'];
        //$contratoviagem->observacao = $dados['observacao'];
        $contratoviagem->datadocontrato = $dados['datadocontrato'];
        //$contratoviagem->status = $dados['status'];
        $contratoviagem->save();
        return redirect('/contratoviagem/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $contratoviagem = DB::table('contratoviagems')
                ->orderBy('contratoviagems.datadocontrato')
                ->where('contratoviagems.empresa_id', '=', Usuario::empresa())
                ->leftJoin('veiculos', 'contratoviagems.veiculo_id', '=', 'veiculos.id')
                ->leftJoin('clientes', 'contratoviagems.cliente_id', '=', 'clientes.id')
                ->select('contratoviagems.id as id',
                        'contratoviagems.empresa_id as empresa_id',
                        'contratoviagems.veiculo_id as veiculo_id',
                        'contratoviagems.cliente_id as cliente_id',
                        'contratoviagems.datadocontrato as datadocontrato',
                        'contratoviagems.localdedestino as localdedestino',
                        'contratoviagems.itinerario as itinerario',
                        'contratoviagems.valor as valor',
                        'contratoviagems.datainicio as datainicio',
                        'contratoviagems.status as status',
                        'clientes.nome as cliente_nome',
                        'clientes.cpfcnpj as cliente_cpf',
                        'clientes.rgie as cliente_rg',
                        'clientes.nascimento as cliente_nascimento',
                        'clientes.tel1 as cliente_tel1',
                        'clientes.sexo as cliente_sexo',
                        'clientes.cidade as cliente_cidade',
                        'clientes.estado as cliente_estado',
                        'clientes.status as cliente_status',
                        'veiculos.nome as veiculo_nome',
                        'veiculos.marcamodelo as marcamodelo',
                        'veiculos.placa as placa',
                        'veiculos.acentos as acentos',
                        'veiculos.status as veiculo_status')
                ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Cliente', 'width' => 10],
            ['label' => 'Telefone', 'width' => 3],
            ['label' => 'Veículo', 'width' => 3],
            ['label' => 'Destino', 'width' => 3],
            ['label' => 'Viagem', 'width' => 3],
            ['label' => 'Valor', 'width' => 1],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 2, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.contratoviagem.listar', compact('contratoviagem', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $contratoviagem = Contratoviagem::find($id);
        if($contratoviagem) {           
            $contratoviagem->delete();
        }
        return redirect('/contratoviagem/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('contratoviagems')->where('id', $id)->update(['status' => '0']);
        return redirect('/contratoviagem/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('contratoviagems')->where('id', $id)->update(['status' => '1']);
        return redirect('/contratoviagem/listar')->withInput(); //redireciona por url
    }
    
    public function imprimircontrato() {
        $id = Request::route('id');
        $contratoviagem = DB::table('contratoviagems')
                ->orderBy('contratoviagems.datadocontrato')
                ->where('contratoviagems.id', '=', $id)
                ->leftJoin('veiculos', 'contratoviagems.veiculo_id', '=', 'veiculos.id')
                ->leftJoin('clientes', 'contratoviagems.cliente_id', '=', 'clientes.id')
                ->select('contratoviagems.id as id',
                        'contratoviagems.empresa_id as empresa_id',
                        'contratoviagems.veiculo_id as veiculo_id',
                        'contratoviagems.cliente_id as cliente_id',
                        'contratoviagems.datadocontrato as datadocontrato',
                        'contratoviagems.localdedestino as localdedestino',
                        'contratoviagems.itinerario as itinerario',
                        'contratoviagems.valor as valor',
                        'contratoviagems.localdedestino as localdedestino',
                        'contratoviagems.localembarqueinicio as localembarqueinicio',
                        'contratoviagems.datainicio as datainicio',
                        'contratoviagems.horainicio as horainicio',
                        'contratoviagems.localembarqueretorno as localembarqueretorno',
                        'contratoviagems.dataretorno as dataretorno',
                        'contratoviagems.horaretorno as horaretorno',
                        'contratoviagems.status as status',
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
        return view('admin.contratoviagem.imprimircontrato')->with('contratoviagem', $contratoviagem);
    }

}
