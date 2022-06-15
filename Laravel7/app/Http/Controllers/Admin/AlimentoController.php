<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Alimento; //Adicionado por Cezar
use App\Http\Requests\AlimentoRequest; //Adicionado por Cezar
use App\Usuario;

class AlimentoController extends Controller {

    private $linhasNaPagina = 7;

    //
    public function cadastrar() {
        return view('admin.alimento.cadastrar')->with('usuario_id', auth()->user()->id);
        ;
    }

    public function gravar(AlimentoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Alimento::create($dados);
        return redirect('/alimento/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $alimento = DB::select('select * from alimentos where id = ?', [$id]);
        return view('admin.alimento.editar')->with('alimento', $alimento);
    }

    public function atualizar(AlimentoRequest $request) {
        $dados = Request::all();
        DB::table('alimentos')->where('id', $dados['id'])->update([
            'nome' => $dados['nome'],
            'composicao' => $dados['composicao'],
            'peso' => $dados['peso'],
            'valor' => $dados['valor'],
            'inicio' => $dados['inicio'],
            'fim' => $dados['fim'],
            'usuario_id' => auth()->user()->id
        ]);
        return redirect('/alimento/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $alimentos = DB::table('alimentos')
                ->where('empresa_id', Usuario::empresa())
                ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Composição', 'width' => 10],
            ['label' => 'Peso', 'width' => 3],
            ['label' => 'Valor', 'width' => 3],
            ['label' => 'Início', 'width' => 3],
            ['label' => 'Término', 'width' => 3],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 2, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.alimento.listar', compact('alimentos', 'cabecalho', 'config'));
    }

    public function listarfiltro(Request $request, Alimento $alimento) {
        $dadosFiltro = Request::all();
        $alimentos = $alimento->filtro($dadosFiltro, $this->linhasNaPagina);
        return view('admin.alimento.listar', compact('alimentos'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $alimento = Alimento::find($id);
        if($alimento) {           
            $alimento->delete();
        }
        return redirect('/alimento/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('alimentos')->where('id', $id)->update(['status' => '0']);
        return redirect('/alimento/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('alimentos')->where('id', $id)->update(['status' => '1']);
        return redirect('/alimento/listar')->withInput(); //redireciona por url
    }

}
