<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Associacaoveiculo; //Adicionado por Cezar
use App\Http\Requests\AssociacaoveiculoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar

class AssociacaoveiculoController extends Controller {

    public function cadastrar() {
        $cores = DB::table('veiculoscor')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('cor')
                ->get();
        $marcas = DB::table('veiculosmarca')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('marca')
                ->get();
        $especies = DB::table('veiculosespecie')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('especie')
                ->get();
        $categorias = DB::table('veiculoscategoria')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('categoria')
                ->get();
        $combustiveis = DB::table('veiculoscombustivel')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('combustivel')
                ->get();
        $carrocerias = DB::table('veiculoscarroceria')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('carroceria')
                ->get();
        $rodados = DB::table('veiculosrodado')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('rodado')
                ->get();
        $linhas = DB::table('veiculoslinha')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('linha')
                ->get();
        $propriedades = DB::table('veiculospropriedade')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('propriedade')
                ->get();
        $tipos = DB::table('veiculostipo')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('tipo')
                ->get();
        $eixos = DB::table('veiculoseixo')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('eixo')
                ->get();
        $clientes = DB::table('clientes')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('nome')
                ->get();
        return view('admin.associacaoveiculo.cadastrar')
                        ->with('cores', $cores)
                        ->with('marcas', $marcas)
                        ->with('especies', $especies)
                        ->with('categorias', $categorias)
                        ->with('combustiveis', $combustiveis)
                        ->with('carrocerias', $carrocerias)
                        ->with('rodados', $rodados)
                        ->with('linhas', $linhas)
                        ->with('propriedades', $propriedades)
                        ->with('tipos', $tipos)
                        ->with('eixos', $eixos)
                        ->with('clientes', $clientes);
    }

    public function gravar(AssociacaoveiculoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        if($dados['nome'] == '') $dados['nome'] = $dados['placa'];
        if($dados['acentos'] == '') $dados['acentos'] = 1;
        Associacaoveiculo::create($dados);
        return redirect('/associacaoveiculo/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $veiculo = DB::table('veiculos')
                ->where('id', $id)
                ->first();
        $cores = DB::table('veiculoscor')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('cor')
                ->get();
        $marcas = DB::table('veiculosmarca')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('marca')
                ->get();
        $especies = DB::table('veiculosespecie')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('especie')
                ->get();
        $categorias = DB::table('veiculoscategoria')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('categoria')
                ->get();
        $combustiveis = DB::table('veiculoscombustivel')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('combustivel')
                ->get();
        $carrocerias = DB::table('veiculoscarroceria')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('carroceria')
                ->get();
        $rodados = DB::table('veiculosrodado')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('rodado')
                ->get();
        $linhas = DB::table('veiculoslinha')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('linha')
                ->get();
        $propriedades = DB::table('veiculospropriedade')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('propriedade')
                ->get();
        $tipos = DB::table('veiculostipo')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('tipo')
                ->get();
        $eixos = DB::table('veiculoseixo')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('eixo')
                ->get();
        $clientes = DB::table('clientes')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', '1')
                ->orderBy('nome')
                ->get();
        return view('admin.associacaoveiculo.editar')
                        ->with('cores', $cores)
                        ->with('marcas', $marcas)
                        ->with('especies', $especies)
                        ->with('categorias', $categorias)
                        ->with('combustiveis', $combustiveis)
                        ->with('carrocerias', $carrocerias)
                        ->with('rodados', $rodados)
                        ->with('linhas', $linhas)
                        ->with('propriedades', $propriedades)
                        ->with('tipos', $tipos)
                        ->with('eixos', $eixos)
                        ->with('clientes', $clientes)
                        ->with('veiculo', $veiculo);
    }

    public function atualizar(AssociacaoveiculoRequest $request) {
        $dados = Request::all();
        $veiculo = Associacaoveiculo::find($dados['id']);
        $veiculo->nome = $dados['nome'];
        $veiculo->marcamodelo = $dados['marcamodelo'];
        $veiculo->placa = $dados['placa'];
        $veiculo->acentos = $dados['acentos'];
        $veiculo->desenho = $dados['desenho'];
        $veiculo->imagem = $dados['imagem'];
        $veiculo->renavam = $dados['renavam'];
        $veiculo->chassi = $dados['chassi'];
        $veiculo->motor = $dados['motor'];
        $veiculo->anofabricacao = $dados['anofabricacao'];
        $veiculo->anomodelo = $dados['anomodelo'];
        $veiculo->cidade = $dados['cidade'];
        $veiculo->uf = $dados['uf'];
        $veiculo->antt = $dados['antt'];
        $veiculo->tara = $dados['tara'];
        $veiculo->capacidade = $dados['capacidade'];
        $veiculo->volume = $dados['volume'];
        $veiculo->valordobem = $dados['valordobem'];
        $veiculo->cor_id = $dados['cor_id'];
        $veiculo->marca_id = $dados['marca_id'];
        $veiculo->especie_id = $dados['especie_id'];
        $veiculo->categoria_id = $dados['categoria_id'];
        $veiculo->combustivel_id = $dados['combustivel_id'];
        $veiculo->carroceria_id = $dados['carroceria_id'];
        $veiculo->rodado_id = $dados['rodado_id'];
        $veiculo->linha_id = $dados['linha_id'];
        $veiculo->propriedade_id = $dados['propriedade_id'];
        $veiculo->tipo_id = $dados['tipo_id'];
        $veiculo->eixo_id = $dados['eixo_id'];
        $veiculo->cilindrada = $dados['cilindrada'];
        $veiculo->codigofipe = $dados['codigofipe'];
        $veiculo->valorfipe = $dados['valorfipe'];
        $veiculo->volume = $dados['volume'];
        $veiculo->observacoes = $dados['observacoes'];
        $veiculo->save();
        return redirect('/associacaoveiculo/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $veiculos = DB::table('veiculos')
                ->leftJoin('clientes', 'veiculos.cliente_id', '=', 'clientes.id')
                ->leftJoin('veiculosmarca', 'veiculos.marca_id', '=', 'veiculosmarca.id')
                ->where('veiculos.empresa_id', Usuario::empresa())
                ->select('veiculos.id as id',
                        'veiculos.empresa_id as empresa_id',
                        'veiculos.cliente_id as cliente_id',
                        'veiculos.nome as nome',
                        'veiculos.placa as placa',
                        'veiculos.acentos as acentos',
                        'veiculos.marcamodelo as marcamodelo',
                        'veiculos.observacoes as observacoes',
                        'veiculos.status as status',
                        'clientes.nome as cliente_nome',
                        'veiculosmarca.marca as marca')
                ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Proprietário', 'width' => 10],
            ['label' => 'Marca Modelo', 'width' => 4],
            ['label' => 'Placa', 'width' => 1],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 2, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.associacaoveiculo.listar', compact('veiculos', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $veiculo = Associacaoveiculo::find($id);
        if($veiculo) {           
            $veiculo->delete();
        }
        return redirect('/associacaoveiculo/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('veiculos')->where('id', $id)->update(['status' => '0']);
        return redirect('/associacaoveiculo/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('veiculos')->where('id', $id)->update(['status' => '1']);
        return redirect('/associacaoveiculo/listar')->withInput(); //redireciona por url
    }

}
