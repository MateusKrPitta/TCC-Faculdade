<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Fornecedor; //Adicionado por Cezar
use App\Http\Requests\FornecedorRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar

class FornecedorController extends Controller {
    
    private $linhasNaPagina = 7;

    public function cadastrar() {
        return view('admin.fornecedor.cadastrar');
    }

    public function gravar(FornecedorRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Fornecedor::create($dados);
        return redirect('/fornecedor/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $fornecedor = DB::table('fornecedores')->where('id','=',$id)->first();
        return view('admin.fornecedor.editar')->with('fornecedor', $fornecedor);
    }

    public function atualizar(FornecedorRequest $request) {
        $dados = Request::all();
        $fornecedor = Fornecedor::find($dados['id']);
        $fornecedor->nome = $dados['nome'];
        $fornecedor->cpfcnpj = $dados['cpfcnpj'];
        $fornecedor->rgie = $dados['rgie'];
        $fornecedor->razaosocial = $dados['razaosocial'];
        $fornecedor->email = $dados['email'];
        $fornecedor->nascimento = $dados['nascimento'];
        $fornecedor->tel1 = $dados['tel1'];
        $fornecedor->tel2 = $dados['tel2'];
        $fornecedor->logradouro = $dados['logradouro'];
        $fornecedor->numero = $dados['numero'];
        $fornecedor->bairro = $dados['bairro'];
        $fornecedor->complemento = $dados['complemento'];
        $fornecedor->cidade = $dados['cidade'];
        $fornecedor->estado = $dados['estado'];
        $fornecedor->cep = $dados['cep'];
        $fornecedor->contatonome = $dados['contatonome'];
        $fornecedor->contatotelefone = $dados['contatotelefone'];
        $fornecedor->contatoemail = $dados['contatoemail'];
        $fornecedor->observacoes = e($dados['observacoes']);
        $fornecedor->save();
        return redirect('/fornecedor/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $fornecedores = DB::table('fornecedores')->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->paginate($this->linhasNaPagina);
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Razão Social', 'width' => 10],
            ['label' => 'CPF / CNPJ', 'width' => 2],
            ['label' => 'RG / IE', 'width' => 2],
            ['label' => 'DN/Abertura', 'width' => 1],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 2, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.fornecedor.listar', compact('fornecedores', 'cabecalho', 'config'));
    }

    public function listarfiltro(Request $request, Fornecedor $fornecedor) {
        //dd(Request::all());
        $dadosFiltro = Request::all();
        $fornecedores = $fornecedor->filtro($dadosFiltro, $this->linhasNaPagina);
        return view('admin.fornecedor.listar', compact('fornecedores'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $fornecedor = Fornecedor::find($id);
        if($fornecedor) {           
            $fornecedor->delete();
        }
        return redirect('/fornecedor/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('fornecedores')->where('id', $id)->where('empresa_id', Usuario::empresa())->update(['status' => '0']);
        return redirect('/fornecedor/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('fornecedores')->where('id', $id)->where('empresa_id', Usuario::empresa())->update(['status' => '1']);
        return redirect('/fornecedor/listar')->withInput(); //redireciona por url
    }

    public static function baixamensal() {
        $ummesatras = Carbon::now('America/Campo_Grande')->addDay(-30); //Pega a data atual e subtrai 30 dias
        return DB::table('fornecedores')->where('status', 0)->where('updated_at', '>', $ummesatras)->count(); //Busca no banco e conta a quantidade de resultados
    }

}
