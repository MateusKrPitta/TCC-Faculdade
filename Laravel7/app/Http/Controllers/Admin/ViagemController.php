<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Viagem; //Adicionado por Cezar
use App\Http\Requests\ViagemRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use App\Veiculo; //Adicionado por Cezar

class ViagemController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        $veiculos = Veiculo::where('status', '=', 1)->where('empresa_id', Usuario::empresadousuario(auth()->user()->id))->get();
        return view('admin.viagem.cadastrar')->with('veiculos', $veiculos);
    }

    public function gravar(ViagemRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        $dados['valor'] = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor
        Viagem::create($dados);
        return redirect('/viagem/cadastrar')->withInput();
    }

    public function editar() {
        $veiculos = Veiculo::where('status', '=', 1)->where('empresa_id', Usuario::empresadousuario(auth()->user()->id))->get();
        $id = Request::route('id');
        $viagem = DB::select('select * from viagems where id = ?', [$id]);
        return view('admin.viagem.editar')->with('viagem', $viagem)->with('veiculos', $veiculos);
    }

    public function atualizar(ViagemRequest $request) {
        $dados = Request::all();
        $dados['valor'] = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor
        $viagem = Viagem::find($dados['id']);
        $viagem->nome = $dados['nome'];
        $viagem->origem = $dados['origem'];
        $viagem->destino = $dados['destino'];
        $viagem->data = $dados['data'];
        $viagem->hora = $dados['hora'];
        $viagem->valor = $dados['valor'];
        $viagem->veiculo_id = $dados['veiculo_id'];
        $viagem->status = $dados['status'];
        $viagem->observacao = $dados['observacao'];
        $viagem->save();
        return redirect('/viagem/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $viagens = DB::table('viagems')
                ->where('viagems.empresa_id', Usuario::empresadousuario(auth()->user()->id))
                ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Origem', 'width' => 3],
            ['label' => 'Destino', 'width' => 3],
            ['label' => 'Data', 'width' => 1],
            ['label' => 'Hora', 'width' => 1],
            ['label' => 'Valor', 'width' => 1],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 2, 'no-export' => true],
        ];
        $config = [
            'order' => [[6, 'asc']],
            'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
        ];
        return view('admin.viagem.listar', compact('viagens', 'cabecalho', 'config'));
    }

    public function listadepassageiros() {
        $id = Request::route('id');
        $viagem = Viagem::where('empresa_id', Usuario::empresa())->where('id', $id)->get();
        $passageiros = DB::table('passagems')
                ->orderBy('acento')
                ->orderBy('clientes.nome')
                ->where('passagems.empresa_id', '=', Usuario::empresa())
                ->where('passagems.viagem_id', '=', $id)
                ->leftJoin('viagems', 'passagems.viagem_id', '=', 'viagems.id')
                ->leftJoin('clientes', 'passagems.cliente_id', '=', 'clientes.id')
                ->select('passagems.id as id',
                        'passagems.empresa_id as empresa_id',
                        'passagems.viagem_id as viagem_id',
                        'passagems.cliente_id as cliente_id',
                        'passagems.acento as acento',
                        'passagems.valor as valor',
                        'passagems.pagamento as pagamento',
                        'passagems.usuario_id as usuario_id',
                        'passagems.status as status',
                        'passagems.localembarque as localembarque',
                        'clientes.nome as cliente_nome',
                        'clientes.cpfcnpj as cliente_cpf',
                        'clientes.rgie as cliente_rg',
                        'clientes.nascimento as cliente_nascimento',
                        'clientes.tel1 as cliente_tel1',
                        'clientes.sexo as cliente_sexo',
                        'clientes.cidade as cliente_cidade',
                        'clientes.estado as cliente_estado',
                        'clientes.status as cliente_status',
                        'viagems.nome as viagem_nome',
                        'viagems.origem as viagem_origem',
                        'viagems.destino as viagem_destino',
                        'viagems.data as viagem_data',
                        'viagems.hora as viagem_hora',
                        'viagems.valor as viagem_valor',
                        'viagems.veiculo_id as viagem_veiculo_id',
                        'viagems.status as viagem_status')
                ->get();
        $somapassagens = DB::table('passagems')
                ->where('passagems.empresa_id', '=', Usuario::empresa())
                ->where('passagems.viagem_id', '=', $id)
                ->sum('valor');
        return view('admin.viagem.listadepassageiros')->with('passageiros', $passageiros)->with('viagem', $viagem)->with('somapassagens', $somapassagens);
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $viagem = Viagem::find($id);
        if($viagem) {           
            $viagem->delete();
        }
        return redirect('/viagem/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('viagems')->where('id', $id)->update(['status' => '0']);
        return redirect('/viagem/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('viagems')->where('id', $id)->update(['status' => '1']);
        return redirect('/viagem/listar')->withInput(); //redireciona por url
    }

    public static function totaldeviagens() {
        return DB::table('viagems')
                ->where('empresa_id', '=', Usuario::empresa())
                ->where('status', '1')
                ->count();
    }

}
