<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Credenciado; //Adicionado por Cezar
use App\Http\Requests\CredenciadoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use App\Credenciadocategoria;

class CredenciadoController extends Controller {

    private $linhasNaPagina = 7;

    public static function novosCredenciados() {
        $total = Credenciado::all()
                ->where('status', '=', 1)
                ->where('empresa_id', '=', Usuario::empresa())
                ->where('created_at', '>', date('Y-m-d', strtotime("-7 days")))
                ->count();
        return $total;
    }

    public static function totalCredenciados() {
        $total = Credenciado::all()
                ->where('status', '=', 1)
                ->where('empresa_id', '=', Usuario::empresa())
                ->count();
        return $total;
    }

    public function cadastrar() {
        $credenciadocategorias = DB::table('credenciadocategorias')
                ->where('status', '=', 1)
                ->where('empresa_id', '=', Usuario::empresa())
                ->get();
        return view('admin.credenciado.cadastrar')->with('credenciadocategorias', $credenciadocategorias);
    }

    public function gravar(CredenciadoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Credenciado::create($dados);
        return redirect('/credenciado/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $usuarioscredenciados = DB::table('userscredenciados')
                ->leftJoin('users', 'userscredenciados.user_id', '=', 'users.id')
                ->where('userscredenciados.status', '=', 1)
                ->where('userscredenciados.empresa_id', '=', Usuario::empresa())
                ->where('userscredenciados.credenciado_id', '=', $id)
                ->get();
        $usuarios = DB::table('users')
                ->where('status', '=', 1)
                ->where('empresa_id', '=', Usuario::empresa())
                ->get();
        $credenciadocategorias = DB::table('credenciadocategorias')
                ->where('status', '=', 1)
                ->where('empresa_id', '=', Usuario::empresa())
                ->get();
        $credenciado = DB::select('select * from credenciados where id = ?', [$id]);
        return view('admin.credenciado.editar')
                        ->with('usuarioscredenciados', $usuarioscredenciados)
                        ->with('usuarios', $usuarios)
                        ->with('credenciado', $credenciado)
                        ->with('credenciadocategorias', $credenciadocategorias);
    }

    public function atualizar(CredenciadoRequest $request) {
        $dados = Request::all();
        $credenciado = Credenciado::find($dados['id']);
        $credenciado->nome = $dados['nome'];
        $credenciado->cpfcnpj = $dados['cpfcnpj'];
        $credenciado->rgie = $dados['rgie'];
        $credenciado->nascimento = $dados['nascimento'];
        $credenciado->sexo = $dados['sexo'];
        $credenciado->tel1 = $dados['tel1'];
        $credenciado->tel2 = $dados['tel2'];
        $credenciado->whatsapp = $dados['whatsapp'];
        $credenciado->instagram = $dados['instagram'];
        $credenciado->facebook = $dados['facebook'];
        $credenciado->email = $dados['email'];
        $credenciado->site = $dados['site'];
        $credenciado->logradouro = $dados['logradouro'];
        $credenciado->numero = $dados['numero'];
        $credenciado->bairro = $dados['bairro'];
        $credenciado->cidade = $dados['cidade'];
        $credenciado->estado = $dados['estado'];
        $credenciado->credenciadocategoria_id = $dados['credenciadocategoria_id'];
        $credenciado->status = $dados['status'];
        $credenciado->save();
        return redirect('/credenciado/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $credenciados = DB::table('credenciados')
                ->where('empresa_id', Usuario::empresa())
                ->get();

        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Telefone 1', 'width' => 3],
            ['label' => 'Cadastro', 'width' => 1],
            ['label' => 'Situação', 'width' => 1],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 2, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.credenciado.listar', compact('credenciados', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $credenciado = Credenciado::find($id);
        if ($credenciado) {
            $credenciado->delete();
        }
        return redirect('/credenciado/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('credenciados')->where('id', $id)->update(['status' => '0']);
        return redirect('/credenciado/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('credenciados')->where('id', $id)->update(['status' => '1']);
        return redirect('/credenciado/listar')->withInput(); //redireciona por url
    }

    public function listarusuarios() {
        $credenciado_id = Request::route('id');
        $credenciado = Credenciado::find($credenciado_id);

        $todosusuarios = DB::table('users')
                ->where('users.empresa_id', '=', Usuario::empresa())
                ->select('users.id as id',
                        'users.name as name',
                        'users.email as email',
                        'users.status as status',
                        'users.created_at as created_at')
                ->orderBy('users.name')
                ->get();

        $usuarios = DB::table('userscredenciados')
                ->leftJoin('users', 'userscredenciados.user_id', '=', 'users.id')
                ->leftJoin('perfils', 'users.perfil_id', '=', 'perfils.id')
                ->leftJoin('credenciados', 'userscredenciados.credenciado_id', '=', 'credenciados.id')
                //->where('userscredenciados.status', '=', 1)
                ->where('users.empresa_id', '=', Usuario::empresa())
                ->where('userscredenciados.empresa_id', '=', Usuario::empresa())
                ->where('credenciados.id', '=', $credenciado_id)
                ->select('userscredenciados.id as id',
                        'users.name as nome',
                        'users.email as email',
                        'userscredenciados.status as status',
                        'users.created_at as created_at',
                        'perfils.nome as perfils_nome')
                ->orderBy('users.name')
                ->get();
        return view('admin.credenciado.listarusuarios')->with('usuarios', $usuarios)->with('todosusuarios', $todosusuarios)->with('credenciado', $credenciado);
    }

    public function gravarusuarios() {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        $dados['status'] = 1;
        $credenciado = Credenciado::find($dados['credenciado_id'])->users()->attach($dados['user_id'], ['status' => 1, 'usuario_id' => $dados['usuario_id'], 'empresa_id' => $dados['empresa_id']]);
        return redirect('/credenciado/listarusuarios/' . $dados['credenciado_id'])->withInput();
    }

    public function apagarusuario() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $credenciado_id = \Illuminate\Support\Facades\Request::route('credenciado_id');
        DB::table('userscredenciados')->where('id', $id)->delete();
        return redirect('/credenciado/listarusuarios/' . $credenciado_id)->withInput(); //redireciona por url
    }

    public function bloquearusuario() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $credenciado_id = \Illuminate\Support\Facades\Request::route('credenciado_id');
        DB::table('userscredenciados')->where('id', $id)->update(['status' => '0']);
        return redirect('/credenciado/listarusuarios/' . $credenciado_id)->withInput(); //redireciona por url
    }

    public function ativarusuario() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $credenciado_id = \Illuminate\Support\Facades\Request::route('credenciado_id');
        DB::table('userscredenciados')->where('id', $id)->update(['status' => '1']);
        return redirect('/credenciado/listarusuarios/' . $credenciado_id)->withInput(); //redireciona por url
    }

    //SITE
    public static function credenciados(int $empresaid) {
        $credenciados = DB::table('credenciados')
                ->where('empresa_id', $empresaid)
                ->get();
        //dd($credenciados);
        return redirect('/credenciado'); //redireciona por url
        
    }

}
