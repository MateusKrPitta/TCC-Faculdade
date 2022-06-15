<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Consulta; //Adicionado por Cezar
use App\Http\Requests\AgendaRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario;
use App\Medico;
use App\Cliente;
use App\Especialidade;
use App\Http\Requests\ConsultaRequest;
////Adicionado por Cezar
//use Illuminate\Http\Request;
class ConsultaController extends Controller
{
    private $linhasNaPagina = 7;
     public function cadastrar()
    {   
        $clientes= Cliente::all()->where('empresa_id', Usuario::empresa());
        $medicos = Medico::all()->where('empresa_id', Usuario::empresa());
        return view('admin.consulta.cadastrar')->with('medicos', $medicos)->with('clientes', $clientes);
    }
    public function gravar(ConsultaRequest $request)
    {
        $dados = Request::all(); /// pegas todas as informações para transferir para o banco
        $dados['empresa_id']= Usuario::empresa();
        $dados['usuario_id']= \Illuminate\Support\Facades\Auth::user()->id;
        Consulta::create($dados);/// comando que salva no banco de dados
        return redirect('/consulta/cadastrar')->withInput();
    }
    public function listar()
    {
        
        $consultas = DB::table('consultas')
                ->where('consultas.empresa_id', Usuario::empresa())
                ->leftJoin('clientes', 'consultas.cliente_id', '=', 'clientes.id')
                ->leftJoin('medicos', 'consultas.medico_id', '=', 'medicos.id')
                ->select('consultas.id as id',                    
                        'clientes.nome as cliente_nome',
                        'medicos.nome as medico_nome',
                        'consultas.horario_consulta as hora',
                        'consultas.data as data',
                        'consultas.status as status')
                ->get();
        $cabecalho = [
            ['label' => 'Cliente', 'width' =>10],
            ['label' => 'Medico', 'width' =>10],
            ['label' => 'Data', 'width' =>3],
            ['label' => 'Hora', 'width' =>3],            
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 3, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        
        //dd($medicos);
        return view('admin.consulta.listar', compact('consultas', 'cabecalho', 'config')); 

        
    }
    public function atualizar(ConsultaRequest $request) {
        $dados = Request::all();
        $consultas = Consulta::find($dados['id']);
        $consultas->cliente_id = $dados['cliente_id'];
        $consultas->medico_id = $dados['medico_id'];
        $consultas ->horario_consulta = $dados['horario_consulta'];
        $consultas ->data = $dados['data'];
        $consultas ->status = $dados['status'];       
        $consultas ->save();
        return redirect('/consulta/listar')->withInput(); //redireciona por url
    }
    public function apagar() 
    {
	$id = \Illuminate\Support\Facades\Request::route('id');
	$consultas = Medico::find($id);
	if($consultas) {           
            $consultas->delete();
        }
	return redirect('/consulta/listar')->withInput(); //redireciona por url
    }
    
    public function bloquear() 
    {
	$id = \Illuminate\Support\Facades\Request::route('id');
	DB::table('consultas')->where('id', $id)->update(['status' => '0']);
	return redirect('/consulta/listar')->withInput(); //redireciona por url
    }
    
    public function ativar() 
    {
	$id = \Illuminate\Support\Facades\Request::route('id');
	DB::table('consultas')->where('id', $id)->update(['status' => '1']);
	return redirect('/consulta/listar')->withInput(); //redireciona por url
    }
    
    public function editar() 
    {
        $clientes= Cliente::all()->where('empresa_id', Usuario::empresa());
        $medicos = Medico::all()->where('empresa_id', Usuario::empresa());
	$id = Request::route('id');
	$consultas = DB::select('select * from consultas where id = ?', [$id]);
	return view('admin.consulta.editar')->with('consultas', $consultas)->with('medicos', $medicos)->with('clientes', $clientes);
    }
}

