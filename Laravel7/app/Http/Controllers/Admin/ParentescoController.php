<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Parentesco; //Adicionado por Cezar
use App\Http\Requests\ParentescoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use App\Sistemalog;


class ParentescoController extends Controller
{
    private $linhasNaPagina = 7;
    public function cadastrar()
    {
        return view('admin.parentesco.cadastrar');
    }
    
    public function gravar()
    {
        $dados = Request::all(); /// pegas todas as informações para transferir para o banco
        $dados['empresa_id']= Usuario::empresa();
        $dados['usuario_id']= \Illuminate\Support\Facades\Auth::user()->id;
        Parentesco::create($dados);/// comando que salva no banco de dados
        return redirect('/parentesco/cadastrar')->withInput();
    }
    public function editar() 
    {
	$id = Request::route('id');
	$parentescos = DB::select('select * from parentescos where id = ?', [$id]);
	return view('admin.parentesco.editar')->with('parentescos', $parentescos);
    }
    
    public function atualizar() 
    {
	$dados = Request::all();
	$parentescos = Exame::find($dados['id']);
	$parentescos->nome = $dados['nome_parentesco'];
	$parentescos->conselhoregional = $dados['conselhoregional '];
	$parentescos->valor_referencia = $dados['valor_referencia'];
        $parentescos->status = $dados['status'];
        $parentescos->observacao = $dados['usuario_id'];
	$parentescos->save();
	return redirect('/parentesco/listar')->withInput(); //redireciona por url
    }
    
    public function listar()
    {
        $parentescos = DB::table('parentescos')->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->paginate($this->linhasNaPagina);
        return view('admin.parentesco.listar', compact('parentescos'));
        
    }
    
    public function apagar() 
    {
	$id = \Illuminate\Support\Facades\Request::route('id');
	$parentescos = Exame::find($id);
	if($parentescos) {           
            $parentescos->delete();
        }
	return redirect('/parentesco/listar')->withInput(); //redireciona por url
    }
    
    public function bloquear() {
		$id = \Illuminate\Support\Facades\Request::route('id');
		DB::table('parentescos')->where('id', $id)->update(['status' => '0']);
		return redirect('/parentesco/listar')->withInput(); //redireciona por url
	}

	public function ativar() {
		$id = \Illuminate\Support\Facades\Request::route('id');
		DB::table('parentescos')->where('id', $id)->update(['status' => '1']);
		return redirect('/parentesco/listar')->withInput(); //redireciona por url
	}
}
