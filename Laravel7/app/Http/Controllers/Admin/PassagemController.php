<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Passagem; //Adicionado por Cezar
use App\Http\Requests\PassagemRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use App\Cliente;
use App\Viagem;
use App\Contasareceber;
use Illuminate\Support\Facades\Redis;

class PassagemController extends Controller {

    public function cadastrar() {
        $clientes = Cliente::where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                        ->where('status', 1)->get();
        $viagens = Viagem::where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                        ->where('status', 1)->get();
        return view('admin.passagem.cadastrar')
                        ->with('clientes', $clientes)
                        ->with('viagens', $viagens);
    }

    public function gravar(PassagemRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresadousuario(auth()->user()->id);
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        $dados['valor'] = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor
        Passagem::create($dados);
        return redirect('/passagem/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $clientes = Cliente::where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                ->where('status', 1)
                ->orderBy('nome')
                ->get();
        $viagens = Viagem::where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                ->where('status', 1)
                ->orderBy('data')
                ->get();
        $passagem = DB::select('select * from passagems where id = ?', [$id]);
        $viagemselecionada = DB::table('viagems')
                ->leftJoin('veiculos', 'viagems.veiculo_id', '=', 'veiculos.id')
                ->where('viagems.id', '=', $passagem[0]->viagem_id)
                ->get();

        for ($i = 1; $i <= $viagemselecionada[0]->acentos; $i++) {
            if (DB::table('passagems')
                            ->where('passagems.empresa_id', '=', Usuario::empresa())
                            ->where('passagems.viagem_id', '=', $passagem[0]->viagem_id)
                            ->where('passagems.acento', '=', $i)
                            ->count()
            ) {
                $passagens = DB::table('passagems')
                        ->where('passagems.empresa_id', '=', Usuario::empresa())
                        ->where('passagems.viagem_id', '=', $passagem[0]->viagem_id)
                        ->where('passagems.acento', '=', $i)
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
                                'clientes.nome as cliente_nome',
                                'clientes.nascimento as cliente_nascimento',
                                'clientes.tel1 as cliente_tel1',
                                'clientes.sexo as cliente_sexo',
                                'clientes.cidade as cliente_cidade',
                                'clientes.estado as cliente_estado',
                                'clientes.status as cliente_status')
                        ->get();
                $acentos[$i]['acento'] = $i;
                $acentos[$i]['nome'] = $i . ' - ' . $passagens[0]->cliente_nome;
                if ($passagens[0]->cliente_sexo == 'M')
                    $acentos[$i]['cor'] = 'text-blue';
                if ($passagens[0]->cliente_sexo == 'F')
                    $acentos[$i]['cor'] = 'text-fuchsia';
            } else {
                $acentos[$i]['acento'] = $i;
                $acentos[$i]['nome'] = $i;
                $acentos[$i]['cor'] = 'text-black';
            }
        }
        return view('admin.passagem.editar')
                        ->with('passagens', $passagens)
                        ->with('passagem', $passagem)
                        ->with('clientes', $clientes)
                        ->with('viagemselecionada', $viagemselecionada)
                        ->with('viagens', $viagens)
                        ->with('acentos', $acentos);
    }

    public function comprar() {
        $id = Request::route('id');
        $clientes = Cliente::where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                ->where('status', 1)
                ->orderBy('nome')
                ->get();
        $viagens = Viagem::where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                        ->where('status', 1)->get();
        return view('admin.passagem.comprar')
                        ->with('clientes', $clientes)
                        ->with('viagens', $viagens)
                        ->with('id', $id);
    }

    public function comprar2() {
        $dados = Request::all();
        $clientes = Cliente::where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                ->where('status', 1)
                ->orderBy('nome')
                ->get();

        $viagens = Viagem::where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                        ->where('status', 1)->get();

        $viagemselecionada = DB::table('viagems')
                ->leftJoin('veiculos', 'viagems.veiculo_id', '=', 'veiculos.id')
                ->where('viagems.id', '=', $dados['viagem_id'])
                ->get();

        for ($i = 1; $i <= $viagemselecionada[0]->acentos; $i++) {
            if (DB::table('passagems')->where('passagems.empresa_id', '=', Usuario::empresa())->where('passagems.viagem_id', '=', $dados['viagem_id'])->where('passagems.acento', '=', $i)->count()) {
                $passagem = DB::table('passagems')
                        ->where('passagems.empresa_id', '=', Usuario::empresa())
                        ->where('passagems.viagem_id', '=', $dados['viagem_id'])
                        ->where('passagems.acento', '=', $i)
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
                                'clientes.nome as cliente_nome',
                                'clientes.nascimento as cliente_nascimento',
                                'clientes.tel1 as cliente_tel1',
                                'clientes.sexo as cliente_sexo',
                                'clientes.cidade as cliente_cidade',
                                'clientes.estado as cliente_estado',
                                'clientes.status as cliente_status')
                        ->get();
                $acentos[$i]['acento'] = $i;
                $acentos[$i]['nome'] = $i . ' - ' . $passagem[0]->cliente_nome;
                $acentos[$i]['cor'] = 'text-green';
                $acentos[$i]['bg-cor'] = 'bg-green';
                if ($passagem[0]->cliente_sexo == 'M') {
                    $acentos[$i]['cor'] = 'text-blue';
                    $acentos[$i]['bg-cor'] = 'bg-blue';
                }
                if ($passagem[0]->cliente_sexo == 'F') {
                    $acentos[$i]['cor'] = 'text-fuchsia';
                    $acentos[$i]['bg-cor'] = 'bg-pink';
                }
            } else {
                $acentos[$i]['acento'] = $i;
                $acentos[$i]['nome'] = $i;
                $acentos[$i]['cor'] = 'text-black';
                $acentos[$i]['bg-cor'] = 'bg-white';
            }
        }
        //dd($viagemselecionada);
        return view('admin.passagem.comprar2')
                        ->with('clientes', $clientes)
                        ->with('viagens', $viagens)
                        ->with('viagemselecionada', $viagemselecionada)
                        ->with('dados', $dados)
                        ->with('acentos', $acentos);
    }

    public function comprargravar(PassagemRequest $request) {
        $dados = Request::all();
        //dd($dados);

        $dados['empresa_id'] = Usuario::empresadousuario(auth()->user()->id);
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        $dados['valor'] = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor
        Passagem::create($dados);
        //Cria contas a receber
        $viagem = Viagem::where('id', '=', $dados['viagem_id'])->get();
        //dd($viagem);
        $descricao = "Passagem: " . $viagem[0]->nome . " - " . $viagem[0]->destino . " - " . date("d/m/Y", strtotime($viagem[0]->data));
        $dados['descricao'] = $descricao;
        $dados['status'] = $dados['pagamento'];
        $dados['vencimento'] = $viagem[0]->data;
        $dados['pagamento'] = $viagem[0]->data;
        $dados['observacao'] = "Gerado automaticamente na compra da passagem";
        Contasareceber::create($dados);
        //fim contas a receber
        return redirect('/cliente/listar')->withInput();
    }

    public function atualizar() {
        $dados = Request::all();
        $dados['valor'] = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor
        $passagem = Passagem::find($dados['id']);
        $passagem->empresa_id = $dados['empresa_id'];
        $passagem->viagem_id = $dados['viagem_id'];
        $passagem->cliente_id = $dados['cliente_id'];
        $passagem->acento = $dados['acento'];
        $passagem->localembarque = $dados['localembarque'];
        $passagem->valor = $dados['valor'];
        $passagem->pagamento = $dados['pagamento'];
        $passagem->status = $dados['status'];
        $passagem->usuario_id = $dados['usuario_id'];
        $passagem->save();
        return redirect('/passagem/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        //$passagens = Passagem::all()->sortBy('nome')->where('empresa_id', Usuario::empresa());
        $passagens = DB::table('passagems')
                ->where('passagems.empresa_id', '=', Usuario::empresa())
                ->leftJoin('viagems', 'passagems.viagem_id', '=', 'viagems.id')
                ->leftJoin('clientes', 'passagems.cliente_id', '=', 'clientes.id')
                ->leftJoin('users', 'passagems.usuario_id', '=', 'users.id')
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
                        'clientes.nascimento as cliente_nascimento',
                        'clientes.tel1 as cliente_tel1',
                        'clientes.sexo as cliente_sexo',
                        'clientes.cidade as cliente_cidade',
                        'clientes.estado as cliente_estado',
                        'clientes.status as cliente_status',
                        'users.name as nomeusuario',
                        'viagems.nome as viagem_nome',
                        'viagems.origem as viagem_origem',
                        'viagems.destino as viagem_destino',
                        'viagems.data as viagem_data',
                        'viagems.hora as viagem_hora',
                        'viagems.valor as viagem_valor',
                        'viagems.veiculo_id as viagem_veiculo_id',
                        'viagems.status as viagem_status')
                ->where('viagems.status', '=', '1')
                ->orderBy('viagem_data')
                ->orderBy('clientes.nome')
                ->get();

        $cabecalho = [
            ['label' => 'Cliente', 'width' => 10],
            ['label' => 'Viagem', 'width' => 10],
            ['label' => 'Data', 'width' => 5],
            ['label' => 'Acento', 'width' => 3],
            ['label' => 'Valor', 'width' => 10],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 3, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        //dd($passagens);
        return view('admin.passagem.listar', compact('passagens', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $passagem = Passagem::find($id);
        if ($passagem) {
            $passagem->delete();
        }
        return redirect('/passagem/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('passagems')->where('id', $id)->update(['status' => '0']);
        return redirect('/passagem/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('passagems')->where('id', $id)->update(['status' => '1']);
        return redirect('/passagem/listar')->withInput(); //redireciona por url
    }

    public static function totaldepassagens() {
        return DB::table('passagems')
                        ->where('passagems.empresa_id', '=', Usuario::empresa())
                        ->leftJoin('viagems', 'passagems.viagem_id', '=', 'viagems.id')
                        ->where('passagems.status', '1')
                        ->where('viagems.status', '1')
                        ->count();
    }

}
