<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Exameexecutado; //Adicionado por Cezar
use App\Http\Requests\ExameexecutadoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use App\Exame;
//use Illuminate\Http\Request;

class ExameexecutadoController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        $exames = DB::table('exames')->where('empresa_id', Usuario::empresa())->get();
        $consultas = DB::table('consultas')->where('empresa_id', Usuario::empresa())->get();
        $medicos = DB::table('medicos')->where('empresa_id', Usuario::empresa())->get();
        $clientes = DB::table('clientes')->where('empresa_id', Usuario::empresa())->get();
        return view('admin.exameexecutado.cadastrar')->with('clientes', $clientes)->with('medicos', $medicos)->with('consultas', $consultas)->with('exames', $exames);
    }

    public function gravar(ExameexecutadoRequest $request) {
        $dados = Request::all(); /// pegas todas as informações para transferir para o banco
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Exameexecutado::create($dados); /// comando que salva no banco de dados
        return redirect('/exameexecutado/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $exames = DB::table('exames')->where('empresa_id', Usuario::empresa())->get();
        $clientes = DB::table('clientes')->where('empresa_id', Usuario::empresa())->get();
        $exameexecutados = DB::table('exameexecutados')->where('id', '=', $id)->where('empresa_id', Usuario::empresa())->get();
        return view('admin.exameexecutado.editar')
                        ->with('exameexecutados', $exameexecutados)
                        ->with('clientes', $clientes)
                        ->with('exames', $exames);
    }

    public function atualizar(ExameexecutadoRequest $request) {
        $dados = Request::all();
        $exameexecutados = Exameexecutado::find($dados['id']);
        $exameexecutados->exame_id = $dados['exame_id'];
        $exameexecutados->cliente_id = $dados['cliente_id'];
        $exameexecutados->resultado = $dados['resultado'];
        $exameexecutados->hora = $dados['hora'];
        $exameexecutados->data = $dados['data'];
        $exameexecutados->status = $dados['status'];
        $exameexecutados->save();
        return redirect('/exameexecutado/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $exameexecutados = DB::table('exameexecutados')
                ->where('exameexecutados.empresa_id', Usuario::empresa())
                ->leftJoin('exames', 'exameexecutados.exame_id', '=', 'exames.id')
                ->leftJoin('clientes', 'exameexecutados.cliente_id', '=', 'clientes.id')
                ->select('exameexecutados.id as id',
                        'exames.nome as exames_nome',
                        'clientes.nome as cliente_nome',
                        'exameexecutados.resultado as resultado',
                        'exameexecutados.hora as hora',
                        'exameexecutados.data as data',
                        'exameexecutados.status as status')
                ->get();
        $cabecalho = [
            ['label' => 'Exame', 'width' => 10],
            ['label' => 'Cliente', 'width' => 10],
            ['label' => 'Hora', 'width' => 5],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 3, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        //dd($medicos);
        return view('admin.exameexecutado.listar', compact('exameexecutados', 'cabecalho', 'config'));
    }


    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $exameexecutadoexecutados = Exame::find($id);
        if($exameexecutadoexecutados) {           
            $exameexecutadoexecutados->delete();
        }
        return redirect('/exameexecutado/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('exameexecutadoexecutados')->where('id', $id)->update(['status' => '0']);
        return redirect('/exameexecutado/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('exameexecutadoexecutados')->where('id', $id)->update(['status' => '1']);
        return redirect('/exameexecutado/listar')->withInput(); //redireciona por url
    }

}
