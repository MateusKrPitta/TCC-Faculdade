<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Telemarketingtransporte; //Adicionado por Cezar
use App\Http\Requests\TelemarketingtransporteRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use App\Cliente;

class TelemarketingtransporteController extends Controller {

    private $linhasNaPagina = 7;
    private $diasdecarencia = 30;

    public static function removeDuplicadosDoArray($array, $indice) {
        $novo = array();
        foreach ($array as $registro) {
            $verificaseexiste = 0;
            foreach ($novo as $novoregistro) {
                if ($novoregistro->$indice == $registro->$indice) {
                    $verificaseexiste = 1;
                }
            }
            if ($verificaseexiste == 0) {
                $novo[] = $registro;
            }
        }
        return $novo;
    }

    public static function removeArrayDoArray($array_inteiro, $array_remover, $indice) {
        $novo = array();
        foreach ($array_inteiro as $registro) {
            $verificaseexiste = 0;
            foreach ($array_remover as $registro_remover) {

                if ($registro_remover->$indice == $registro->$indice) {
                    $verificaseexiste = 1;
                }
            }
            if ($verificaseexiste == 0) {
                $novo[] = $registro;
            }
        }
        return $novo;
    }

    public function cadastrar() {

        //Busca todos os clientes
        $listadeclientes = DB::table('clientes')
                ->leftJoin('telemarketingtransportes', 'clientes.id', '=', 'telemarketingtransportes.cliente_id')
                ->leftJoin('users', 'telemarketingtransportes.usuario_id', '=', 'users.id')
                ->whereNotBetween('clientes.created_at', [date('Y-m-d', (strtotime('-30 days'))), date('Y-m-d', (strtotime('1 day')))])
                ->where('clientes.empresa_id', Usuario::empresadousuario(auth()->user()->id))
                ->where('clientes.status', 1)
                ->select(
                        'telemarketingtransportes.descricao as descricao',
                        'telemarketingtransportes.created_at as data',
                        'telemarketingtransportes.status as status',
                        'clientes.id as cliente_id', 
                        'clientes.id as id',
                        'clientes.tel1 as tel1',
                        'clientes.tel2 as tel2',
                        'clientes.nome as nome',
                        'users.name as nomeusuario',
                        'users.email as emailusuario'
                )
                ->orderBy('telemarketingtransportes.id', 'desc')
                ->orderBy('clientes.nome', 'asc')
                ->get();

        //Busca todos os clientes que precisam ser removidos
        $remover = DB::table('clientes')
                ->where('clientes.empresa_id', Usuario::empresadousuario(auth()->user()->id))
                ->where('clientes.status', 1)
                ->select(
                        'telemarketingtransportes.descricao as descricao',
                        'telemarketingtransportes.created_at as data',
                        'telemarketingtransportes.status as status',
                        'clientes.id as cliente_id', 
                        'clientes.id as id',
                        'clientes.tel1 as tel1',
                        'clientes.tel2 as tel2',
                        'clientes.nome as nome'
                )
                ->orderBy('clientes.id')
                ->leftJoin('telemarketingtransportes', 'clientes.id', '=', 'telemarketingtransportes.cliente_id')
                ->whereBetween('telemarketingtransportes.created_at', [date('Y-m-d', (strtotime('-30 days'))), date('Y-m-d', (strtotime('1 day')))])
                ->get();

        $remover2 = DB::table('clientes')
                ->where('clientes.empresa_id', Usuario::empresadousuario(auth()->user()->id))
                ->where('clientes.status', 1)
                ->select(
                        'clientes.id as cliente_id', 
                        'clientes.id as id',
                        'clientes.tel1 as tel1',
                        'clientes.tel2 as tel2',
                        'clientes.nome as nome'
                )
                ->orderBy('clientes.id')
                ->leftJoin('passagems', 'clientes.id', '=', 'passagems.cliente_id')
                ->whereNotBetween('passagems.created_at', [date('Y-m-d', (strtotime('-30 days'))), date('Y-m-d', (strtotime('1 day')))])
                ->get();

        //Remove duplicados
        $listadeclientes = self::removeDuplicadosDoArray($listadeclientes, 'id');
        $remover = self::removeDuplicadosDoArray($remover, 'id');
        $remover2 = self::removeDuplicadosDoArray($remover2, 'id');

        //Remove os clientes que não devem receber ligações
        $resultado = self::removeArrayDoArray($listadeclientes, $remover, 'id');
        $clientes = self::removeArrayDoArray($resultado, $remover2, 'id');

        return view('admin.telemarketingtransporte.cadastrar', compact('clientes'));
    }

    public function cadastrar1() {
        $id = Request::route('id');
        $cliente = Cliente::find($id);
        return view('admin.telemarketingtransporte.cadastrar1')->with('cliente', $cliente);
    }

    public function gravar(TelemarketingtransporteRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Telemarketingtransporte::create($dados);
        if ($dados['botaogravar'] == 'gravar') {
            return redirect('/telemarketingtransporte/cadastrar')->withInput();
        }
        if ($dados['botaogravar'] == 'vender') {
            return redirect('/passagem/comprar/' . $dados['cliente_id'])->withInput();
        }
        if ($dados['botaogravar'] == 'bloquear') {
            DB::table('clientes')->where('id', $dados['cliente_id'])->update(['status' => '0']);
            return redirect('/telemarketingtransporte/cadastrar')->withInput();
        }
    }

    public function editar() {
        $id = Request::route('id');
        $telemarketingtransporte = DB::select('select * from telemarketingtransportes where id = ?', [$id]);
        return view('admin.telemarketingtransporte.editar')->with('telemarketingtransporte', $telemarketingtransporte);
    }

    public function atualizar() {
        $dados = Request::all();
        $telemarketingtransporte = Telemarketingtransporte::find($dados['id']);
        $telemarketingtransporte->nome = $dados['nome'];
        $telemarketingtransporte->cpfcnpj = $dados['cpfcnpj'];
        $telemarketingtransporte->rgie = $dados['rgie'];
        $telemarketingtransporte->nascimento = $dados['nascimento'];
        $telemarketingtransporte->tel1 = $dados['tel1'];
        $telemarketingtransporte->tel2 = $dados['tel2'];
        $telemarketingtransporte->sexo = $dados['sexo'];
        $telemarketingtransporte->logradouro = $dados['logradouro'];
        $telemarketingtransporte->numero = $dados['numero'];
        $telemarketingtransporte->bairro = $dados['bairro'];
        $telemarketingtransporte->cidade = $dados['cidade'];
        $telemarketingtransporte->estado = $dados['estado'];
        $telemarketingtransporte->status = $dados['status'];
        $telemarketingtransporte->save();
        return redirect('/telemarketingtransporte/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $telemarketingtransportes = DB::table('telemarketingtransportes')
                ->where('telemarketingtransportes.empresa_id', Usuario::empresadousuario(auth()->user()->id))
                ->leftJoin('clientes', 'telemarketingtransportes.cliente_id', '=', 'clientes.id')
                ->leftJoin('users', 'telemarketingtransportes.usuario_id', '=', 'users.id')
                ->select(
                        'telemarketingtransportes.id as id',
                        'telemarketingtransportes.cliente_id as cliente_id',
                        'telemarketingtransportes.descricao as descricao',
                        'telemarketingtransportes.created_at as data',
                        'telemarketingtransportes.status as status',
                        'clientes.tel1 as tel1',
                        'clientes.tel2 as tel2',
                        'clientes.nome as nome',
                        'users.name as nomeusuario',
                        'users.email as emailusuario'
                )
                ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Telefone', 'width' => 3],
            ['label' => 'Descrição da Conversa', 'width' => 13],
            ['label' => 'Último Contato', 'width' => 4],
            ['label' => 'Telefonista', 'width' => 6],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false]],
        ];
        return view('admin.telemarketingtransporte.listar', compact('telemarketingtransportes', 'cabecalho', 'config'));
    }

    public function listarfiltro(Request $request, Telemarketingtransporte $telemarketingtransporte) {
        //dd(Request::all());
        $dadosFiltro = Request::all();
        $telemarketingtransportes = $telemarketingtransporte->filtro($dadosFiltro, $this->linhasNaPagina);
        return view('admin.telemarketingtransporte.listar', compact('telemarketingtransportes'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $telemarketingtransporte = Telemarketingtransporte::find($id);
        if($telemarketingtransporte) {           
            $telemarketingtransporte->delete();
        }
        return redirect('/telemarketingtransporte/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('telemarketingtransportes')->where('id', $id)->update(['status' => '0']);
        return redirect('/telemarketingtransporte/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('telemarketingtransportes')->where('id', $id)->update(['status' => '1']);
        return redirect('/telemarketingtransporte/listar')->withInput(); //redireciona por url
    }

    public static function baixamensal() {
        $ummesatras = Carbon::now('America/Campo_Grande')->addDay(-30); //Pega a data atual e subtrai 30 dias
        return DB::table('telemarketingtransportes')->where('status', 0)->where('updated_at', '>', $ummesatras)->count(); //Busca no banco e conta a quantidade de resultados
    }

    public static function totaldeligacoes() {
        return DB::table('telemarketingtransportes')
                        ->where('telemarketingtransportes.status', '1')
                        ->where('telemarketingtransportes.created_at', '>', date('Y-m-1') )
                        ->count();
    }

}
