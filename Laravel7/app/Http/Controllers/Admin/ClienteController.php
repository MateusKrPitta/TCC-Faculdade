<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Cliente; //Adicionado por Cezar
use App\Http\Requests\ClienteRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use App\Sistemalog;

class ClienteController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        return view('admin.cliente.cadastrar');
    }

    public function gravar(ClienteRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Cliente::create($dados);
        return redirect('/cliente/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        //$cliente = DB::select('select * from clientes where id = ?', [$id]);
        $cliente = DB::table('clientes')
                ->where('id','=',$id)
                ->first();
        return view('admin.cliente.editar')->with('cliente', $cliente);
    }

    public function atualizar(ClienteRequest $request) {
        $dados = Request::all();
        $cliente = Cliente::find($dados['id']);
        $cliente->nome = $dados['nome'];
        $cliente->cpfcnpj = $dados['cpfcnpj'];
        $cliente->rgie = $dados['rgie'];
        $cliente->razaosocial = $dados['razaosocial'];
        $cliente->email = $dados['email'];
        $cliente->nascimento = $dados['nascimento'];
        $cliente->tel1 = $dados['tel1'];
        $cliente->tel2 = $dados['tel2'];
        $cliente->sexo = $dados['sexo'];
        $cliente->logradouro = $dados['logradouro'];
        $cliente->numero = $dados['numero'];
        $cliente->bairro = $dados['bairro'];
        $cliente->complemento = $dados['complemento'];
        $cliente->cidade = $dados['cidade'];
        $cliente->estado = $dados['estado'];
        $cliente->cep = $dados['cep'];
        $cliente->contatonome = $dados['contatonome'];
        $cliente->contatotelefone = $dados['contatotelefone'];
        $cliente->contatoemail = $dados['contatoemail'];
        $cliente->observacoes = e($dados['observacoes']);
        $cliente->save();
        return redirect('/cliente/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $clientes = DB::table('clientes')->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Telefone 1', 'width' => 3],
            ['label' => 'CPF / CNPJ', 'width' => 3],
            ['label' => 'RG / IE', 'width' => 3],
            ['label' => 'Nascimento', 'width' => 3],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 4, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false], ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.cliente.listar', compact('clientes', 'cabecalho', 'config'));
    }

    public function listarfiltro(Request $request, Cliente $cliente) {
        $dadosFiltro = Request::all();
        $clientes = $cliente->filtro($dadosFiltro, $this->linhasNaPagina);
        return view('admin.cliente.listar', compact('clientes'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $cliente = Cliente::find($id);
        Sistemalog::registra(Usuario::empresa(), \Illuminate\Support\Facades\Auth::user()
                ->id, 'cliente', 'Apagar', 'Antes', $cliente['nome'].' '.$cliente['cpfcnpj'].' '.$cliente['tel1']);        
        $cliente->delete();
        return redirect('/cliente/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('clientes')->where('id', $id)->update(['status' => '0']);
        return redirect('/cliente/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('clientes')->where('id', $id)->update(['status' => '1']);
        return redirect('/cliente/listar')->withInput(); //redireciona por url
    }

    public static function baixamensal() {
        $ummesatras = Carbon::now('America/Campo_Grande')->addDay(-30); //Pega a data atual e subtrai 30 dias
        return DB::table('clientes')->where('status', 0)->where('updated_at', '>', $ummesatras)->count(); //Busca no banco e conta a quantidade de resultados
    }

}
