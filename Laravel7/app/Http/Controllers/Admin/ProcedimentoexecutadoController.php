<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Procedimento; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use App\Sistemalog;
use App\Especialidade;
use App\Http\Requests\ProcedimentoexecutadoRequest;
use App\Medico;
use App\Procedimentoexecutado;

class ProcedimentoexecutadoController extends Controller {

    public function cadastrar() {
        $clientes = DB::table('clientes')->where('empresa_id', Usuario::empresa())->get();
        $medicos = DB::table('medicos')->where('empresa_id', Usuario::empresa())->get();
        $procedimentos = DB::table('procedimentos')->where('empresa_id', Usuario::empresa())->get();
        return view('admin.procedimentoexecutado.cadastrar')->with('procedimentos', $procedimentos)->with('medicos', $medicos)->with('clientes', $clientes);
    }

    public function gravar(ProcedimentoexecutadoRequest $request) {

        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        if ($dados['valor'] == ''){
            $procedimento = Procedimento::find(['procedimento_id']);
            $dados['valor'] = $procedimento->valor;       
        }
        else{
            $dados['valor'] = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor
        }
        // dd($dados);
        Procedimentoexecutado::create($dados); /// comando que salva no banco de dados
        return redirect('/procedimentoexecutado/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $clientes = DB::table('clientes')->where('empresa_id', Usuario::empresa())->get();
        $medicos = DB::table('medicos')->where('empresa_id', Usuario::empresa())->get();
        $procedimentos = DB::table('procedimentos')->where('empresa_id', Usuario::empresa())->get();
        $procedimentoexecutado = DB::table('procedimentoexecutados')->where('id','=', $id)->where('empresa_id', Usuario::empresa())->get();
        return view('admin.procedimentoexecutado.editar')
                ->with('procedimentoexecutado', $procedimentoexecutado)
                ->with('procedimentos', $procedimentos)
                ->with('medicos', $medicos)
                ->with('clientes', $clientes);
    }

    public function listar() {
        $procedimentoexecutados = DB::table('procedimentoexecutados')
                ->where('procedimentoexecutados.empresa_id', Usuario::empresa())
                ->leftJoin('procedimentos', 'procedimentoexecutados.procedimento_id', '=', 'procedimentos.id')
                ->leftJoin('clientes', 'procedimentoexecutados.cliente_id', '=', 'clientes.id')
                ->leftJoin('medicos', 'procedimentoexecutados.medico_id', '=', 'medicos.id')
                ->select('procedimentoexecutados.id as id',
                        'medicos.nome as medico_nome',
                        'clientes.nome as cliente_nome',
                        'procedimentoexecutados.valor as valor',
                        'procedimentoexecutados.data_da_execucao as data',
                        'procedimentos.nome as procedimento_nome',
                        'procedimentos.status as status')
                
                ->get();
        $cabecalho = [
            ['label' => 'Procedimento', 'width' =>10],
            ['label' => 'Medico', 'width' =>10],
            ['label' => 'Cliente', 'width' =>10],
            ['label' => 'Data Procedimento', 'width' =>5],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 3, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        //dd($medicos);
        return view('admin.procedimentoexecutado.listar', compact('procedimentoexecutados', 'cabecalho', 'config'));
    }

    public function atualizar(ProcedimentoexecutadoRequest $request) {
        $dados = Request::all();
        $procedimentoexecutados = Procedimentoexecutado::find($dados['id']);
        $procedimentoexecutados->procedimento_id = $dados['procedimento_id'];
        $procedimentoexecutados->medico_id = $dados['medico_id'];
        $procedimentoexecutados->cliente_id = $dados['cliente_id'];
        $procedimentoexecutados->data_da_execucao = $dados['data_da_execucao'];
        $procedimentoexecutados->valor = $dados['valor'];       
        $procedimentoexecutados->status = $dados['status'];
        $procedimentoexecutados->save();
        return redirect('/procedimentoexecutado/listar')->withInput(); //redireciona por url
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $procedimentosexecutados = Procedimentoexecutado::find($id);
        if($procedimentosexecutados) {           
            $procedimentosexecutados->delete();
        }
        return redirect('/procedimentoexecutado/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('procedimentoexecutados')->where('id', $id)->update(['status' => '0']);
        return redirect('/procedimentoexecutado/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('procedimentoexecutados')->where('id', $id)->update(['status' => '1']);
        return redirect('/procedimentexecutado/listar')->withInput(); //redireciona por url
    }

}
