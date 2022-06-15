<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Auth; //Adicionado por Cezar
use App\Http\Requests\UsuarioRequest; //Adicionado por Cezar
use App\Http\Requests\SenhaRequest; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Usuario;
use App\Empresa;
use App\Perfil;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller {

    public function cadastrar() {
        $empresas = Empresa::all();
        $perfis = Perfil::all()->sortBy('nome');
        return view('admin.usuario.cadastrar')
                        ->with('empresas', $empresas)
                        ->with('perfis', $perfis);
    }

    public function gravar(UsuarioRequest $request) {
        $dados = Request::all();
        $dados['usuario_id'] = Auth::user()->id;
        $dados['password'] = bcrypt($dados['password']);
        //dd($dados);
        Usuario::create($dados);
        return redirect('/usuarios/cadastrar')->withInput();
    }

    public function listar() {
        $usuarios = DB::table('users')
                ->leftJoin('empresas', 'users.empresa_id', '=', 'empresas.id')
                ->leftJoin('perfils', 'users.perfil_id', '=', 'perfils.id')
                ->where('empresa_id', Usuario::empresa())
                ->select('users.id as id',
                        'users.name as nome',
                        'users.email as email',
                        'users.status as status',
                        'users.updated_at as updated_at',
                        'perfils.nome as perfils_nome',
                        'empresas.nome as empresas_nome')
                ->get();

        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Empresa', 'width' => 10],
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'E-Mail', 'width' => 3],
            ['label' => 'Perfil', 'width' => 3],
            ['label' => 'Alterado', 'width' => 3],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 2, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc'],[1, 'asc']],
            'columns' => [null, null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.usuario.listar', compact('usuarios', 'cabecalho', 'config'));
    }

    public function editar() {
        $empresas = Empresa::all();
        $perfis = Perfil::all()->sortBy('nome');
        //$id = Request::input('id', '1');
        $id = \Illuminate\Support\Facades\Request::route('id');
        //$usuario = Usuario::find($id);
        $usuario = DB::table('users')
                ->where('id', $id)
                ->first();
        return view('admin.usuario.editar')
                        ->with('usuario', $usuario)
                        ->with('empresas', $empresas)
                        ->with('perfis', $perfis);
    }

    public function perfil() {
        $usuario = Usuario::find(Auth::user()->id);
        return view('admin.usuario.perfil')
                        ->with('usuario', $usuario);
    }

    public function alterarsenha() {
        return view('admin.usuario.alterarsenha');
    }

    public function atualizar() {
        $dados = Request::all();
        if (!isset($dados['id']))
            $dados['id'] = Auth::user()->id;
        //$usuario = new Usuario($dados);
        //verifica se a senha foi alterada e criptografa
        $senhaantiga = DB::select('select password from users where id = ?', [$dados['id']]);
        if (isset($dados['password'])) {
            if ($dados['password'] != $senhaantiga[0]->password)
                $dados['password'] = bcrypt($dados['password']);
        }
        $usuario = Usuario::find($dados['id']);
        if (isset($dados['name']))
            $usuario->name = $dados['name'];
        if (isset($dados['empresa_id']))
            $usuario->empresa_id = $dados['empresa_id'];
        if (isset($dados['usuario_id']))
            $usuario->usuario_id = $dados['usuario_id'];
        if (isset($dados['perfil_id']))
            $usuario->perfil_id = $dados['perfil_id'];
        if (isset($dados['email']))
            $usuario->email = $dados['email'];
        if (isset($dados['password']))
            $usuario->password = $dados['password'];
        if (isset($dados['status']))
            $usuario->status = $dados['status'];
        $usuario->save();
        return redirect('/home')->withInput(); //redireciona por url
    }

    public function atualizarsenha(SenhaRequest $request) {
        $dados = Request::all();
        $dados['id'] = Auth::user()->id;
        //verifica se a senha foi alterada e criptografa
        $senhaantiga = DB::select('select password from users where id = ?', [$dados['id']]);
        //verifica se uma senha foi digitada
        if (isset($dados['password'])) {
            print ("verifica se a senha digitada é igual a atual");
            if (Hash::check($dados['password'], $senhaantiga[0]->password)) {
                print ("Verifica se a nova senha foi diigtada e confirmada");
                if (isset($dados['password1']) && isset($dados['password2'])) {
                    print "Verifica de a nova senha e a confirmação são iguais";
                    if ($dados['password1'] == $dados['password2']) {
                        $usuario = Usuario::find($dados['id']);
                        $usuario->password = Hash::make($dados['password1']);
                        $usuario->save();
                        return redirect('/home')->withInput(); //redireciona por url
                    } else {
                        print("A nova senha e a confirmação não são iguais.");
                        return redirect('/usuarios/alterarsenha')->withInput();
                    }
                } else {
                    print("A nova senha ou a confirmação não foram inseridas.");
                    return redirect('/usuarios/alterarsenha')->withInput();
                }
            } else {
                print("A senha atual não corresponde. Senha digitada: " . $dados['password'] . " - Senha Antiga: " . $senhaantiga[0]->password . " - Senha Atual: ");
                return redirect('/usuarios/alterarsenha')->withInput();
            }
        } else {
            print("Não foi definido uma senha.");
            return redirect('/usuarios/alterarsenha')->withInput();
        }
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $usuario = Usuario::find($id);
        if($usuario) {           
            $usuario->delete();
        }
        return redirect('/usuarios/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('users')->where('id', $id)->update(['status' => '0']);
        return redirect('/usuarios/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('users')->where('id', $id)->update(['status' => '1']);
        return redirect('/usuarios/listar')->withInput(); //redireciona por url
    }

}
