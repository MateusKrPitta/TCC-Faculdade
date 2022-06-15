<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Permissao; //Adicionado por Cezar
use App\PermissaoUsuario; //Adicionado por Cezar
use App\Http\Requests\PermissaoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario;
use App\Empresa;
use App\Perfil;
use App\Grupopermissao;

class PermissaoUsuarioController extends Controller {

    private $linhasNaPagina = 1000;

    public function listarusuarios() {
        $usuarios = DB::table('users')
                ->leftJoin('empresas', 'users.empresa_id', '=', 'empresas.id')
                ->leftJoin('perfils', 'users.perfil_id', '=', 'perfils.id')
               // ->where('empresa_id', Usuario::empresa())
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
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 2, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc'],[1, 'asc']],
            'columns' => [null, null, null,  null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.permissaousuario.listarusuarios', compact('usuarios', 'cabecalho', 'config'));
    }

    public function listar() {
        $id = Request::route('id');
        $usuario = Usuario::find($id);
        $grupos = Grupopermissao::all()->sortBy("id");
        //$permissoes = Permissao::all()->sortBy("nome");
        $permissoes = DB::table('permissaos')->orderBy('nome')
                ->paginate($this->linhasNaPagina);
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Permissão', 'width' => 10],
            ['label' => 'Grupo', 'width' => 10],
            ['label' => 'Ações', 'width' => 1, 'no-export' => true],
        ];
        $config = [
            'order' => [[1, 'asc'],[0, 'asc']],
            'columns' => [null, null, ['orderable' => false]],
        ];
        $permissoesdousuario = PermissaoUsuario::where('usuario_id', $id)->get();
        return view('admin.permissaousuario.listar', compact('permissoes', 'cabecalho', 'config'))
                        ->with('usuario', $usuario)
                        ->with('grupos', $grupos)
                        ->with('permissoesdousuario', $permissoesdousuario);
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $var = explode("a", $id);
        $permissao_id = $var[0];
        $usuario_id = $var[1];
        $dados = Request::all();
        $dados['usuario_id'] = $usuario_id;
        $dados['permissao_id'] = $permissao_id;
        PermissaoUsuario::where('usuario_id', $dados['usuario_id'])
                ->where('permissao_id', $dados['permissao_id'])->delete();
        $url1 = "/permissaousuario/listar/" . $usuario_id;
        return redirect($url1); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $var = explode("a", $id);
        $permissao_id = $var[0];
        $usuario_id = $var[1];
        $dados = Request::all();
        $dados['usuario_id'] = $usuario_id;
        $dados['permissao_id'] = $permissao_id;
        PermissaoUsuario::create($dados);
        $url1 = "/permissaousuario/listar/" . $usuario_id;
        return redirect($url1); //redireciona por url
    }

}
