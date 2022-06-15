<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Plano; //Adicionado por Cezar
use App\Http\Requests\PlanoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar

class PlanoController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        return view('admin.plano.cadastrar');
    }

    public function gravar(PlanoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        $dados['valor'] = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor
        Plano::create($dados);
        return redirect('/plano/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $plano = DB::select('select * from planos where id = ?', [$id]);
        return view('admin.plano.editar')->with('plano', $plano);
    }

    public function atualizar() {
        $dados = Request::all();
        $plano = Plano::find($dados['id']);
        $plano->nome = $dados['nome'];
        $plano->valor = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor
        $plano->tempodeduracao = $dados['tempodeduracao'];
        $plano->quantidadedependentes = $dados['quantidadedependentes'];
        $plano->status = $dados['status'];
        $plano->save();
        return redirect('/plano/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $planos = DB::table('planos')->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->get();
        
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Valor', 'width' => 2],
            ['label' => 'Tempo', 'width' => 1],
            ['label' => 'Dependentes', 'width' => 1],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 1, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.plano.listar', compact('planos', 'cabecalho', 'config'));
    }

    public function listarfiltro(Request $request, Plano $plano) {
        //dd(Request::all());
        $dadosFiltro = Request::all();
        $planos = $plano->filtro($dadosFiltro, $this->linhasNaPagina);
        return view('admin.plano.listar', compact('planos'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $plano = Plano::find($id);
        if($plano) {           
            $plano->delete();
        }
        return redirect('/plano/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('planos')->where('id', $id)->update(['status' => '0']);
        return redirect('/plano/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('planos')->where('id', $id)->update(['status' => '1']);
        return redirect('/plano/listar')->withInput(); //redireciona por url
    }

    public static function baixamensal() {
        $ummesatras = Carbon::now('America/Campo_Grande')->addDay(-30); //Pega a data atual e subtrai 30 dias
        return DB::table('planos')->where('status', 0)->where('updated_at', '>', $ummesatras)->count(); //Busca no banco e conta a quantidade de resultados
    }

}
