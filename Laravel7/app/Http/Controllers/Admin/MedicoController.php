<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Medico; //Adicionado por Cezar
use App\Http\Requests\MedicoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use App\Sistemalog;



class MedicoController extends Controller
{
    private $linhasNaPagina = 7;
    public function cadastrar()
    {
        $especialidades = DB::table('especialidades')->where('empresa_id', Usuario::empresa())->get();
        return view('admin.medico.cadastrar')->with('especialidades', $especialidades);
    }
    
    public function gravar()
    {
        $dados = Request::all(); /// pegas todas as informações para transferir para o banco
        $dados['empresa_id']= Usuario::empresa();
        $dados['usuario_id']= \Illuminate\Support\Facades\Auth::user()->id;
        Medico::create($dados);/// comando que salva no banco de dados
        return redirect('/medico/cadastrar')->withInput();
        
    }
    public function atualizar() 
    {
	$dados = Request::all();
	$medicos = Medico::find($dados['id']);
	$medicos->nome = $dados['nome'];
	$medicos->numeroconselhoregional = $dados['numeroconselhoregional'];
	$medicos->status = $dados['status'];
        $medicos->save();
	return redirect('/medico/listar'); //redireciona por url
    }
    public function editar() 
    {
        $id = Request::route('id');
        $especialidades = DB::table('especialidades')->where('empresa_id', Usuario::empresa())->get();	
	$medicos = DB::select('select * from medicos where id = ?', [$id]);
	return view('admin.medico.editar')->with('medicos', $medicos)->with('especialidades',  $especialidades);
    }
    
    public function listar()
    {        
        //$medicos = Medico::all()->sortBy('nome')->where('empresa_id', Usuario::empresa());
        $medicos = DB::table('medicos')
                ->where('medicos.empresa_id', Usuario::empresa())
                ->leftJoin('especialidades','medicos.especialidade_id','=','especialidades.id')
                ->select('medicos.id as id',
                        'medicos.nome as nome',
                        'especialidades.nome as nome_especialidade', 
                        'medicos.numeroconselhoregional as numeroconselhoregional', 
                        'medicos.status as status')
                ->get();
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Especialidade', 'width' => 10],
            ['label' => 'Número Conselho Regional', 'width' => 10],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 3, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        //dd($medicos);
        return view('admin.medico.listar', compact('medicos', 'cabecalho', 'config'));
        
    }
    public function listarfiltro(Request $request, Medico $medico) {
        $dadosFiltro = Request::all();
        $medicos = $medico->filtro($dadosFiltro, $this->linhasNaPagina);
        return view('admin.medico.listar', compact('medicos'));
    }
    
    public function apagar() 
    {
	$id = \Illuminate\Support\Facades\Request::route('id');
	$medicos = Medico::find($id);
	if($medicos) {           
            $medicos->delete();
        }
	return redirect('/medico/listar')->withInput(); //redireciona por url
    }
    
    public function bloquear() 
    {
	$id = \Illuminate\Support\Facades\Request::route('id');
	DB::table('medicos')->where('id', $id)->update(['status' => '0']);
	return redirect('/medico/listar')->withInput(); //redireciona por url
    }
    
    public function ativar() 
    {
	$id = \Illuminate\Support\Facades\Request::route('id');
	DB::table('medicos')->where('id', $id)->update(['status' => '1']);
	return redirect('/medico/listar')->withInput(); //redireciona por url
    }
}
