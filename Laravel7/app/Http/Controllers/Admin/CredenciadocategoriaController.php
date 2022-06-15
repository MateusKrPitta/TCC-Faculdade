<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Credenciadocategoria; //Adicionado por Cezar
use App\Http\Requests\CredenciadocategoriaRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use App\Sistemalog;


class CredenciadocategoriaController extends Controller
{
    private $linhasNaPagina = 7;
    public function cadastrar()
    {
        return view('admin.credenciadocategoria.cadastrar');
    }
    
    public function gravar()
    {
        $dados = Request::all(); /// pegas todas as informações para transferir para o banco
        $dados['empresa_id']= Usuario::empresa();
        $dados['usuario_id']= \Illuminate\Support\Facades\Auth::user()->id;
        Credenciadocategoria::create($dados);/// comando que salva no banco de dados
        return redirect('/credenciadocategoria/cadastrar')->withInput();
    }
    public function editar() 
    {
	$id = Request::route('id');
	$credenciadocategorias = DB::select('select * from credenciadocategorias where id = ?', [$id]);
	return view('admin.credenciadocategoria.editar')->with('credenciadocategorias', $credenciadocategorias);
    }
    
    public function atualizar() 
    {
	$dados = Request::all();
	$credenciadocategorias = Exame::find($dados['id']);
	$credenciadocategorias->nome = $dados['nome_credenciadocategoria'];
	$credenciadocategorias->conselhoregional = $dados['conselhoregional '];
	$credenciadocategorias->valor_referencia = $dados['valor_referencia'];
        $credenciadocategorias->status = $dados['status'];
        $credenciadocategorias->observacao = $dados['usuario_id'];
	$credenciadocategorias->save();
	return redirect('/credenciadocategoria/listar')->withInput(); //redireciona por url
    }
    
    public function listar()
    {
        $credenciadocategorias = DB::table('credenciadocategorias')->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->paginate($this->linhasNaPagina);
        return view('admin.credenciadocategoria.listar', compact('credenciadocategorias'));
        
    }
    
    public function apagar() 
    {
	$id = \Illuminate\Support\Facades\Request::route('id');
	$credenciadocategorias = Exame::find($id);
	if($credenciadocategorias) {           
            $credenciadocategorias->delete();
        }
	return redirect('/credenciadocategoria/listar')->withInput(); //redireciona por url
    }
    
    public function bloquear() {
		$id = \Illuminate\Support\Facades\Request::route('id');
		DB::table('credenciadocategorias')->where('id', $id)->update(['status' => '0']);
		return redirect('/credenciadocategoria/listar')->withInput(); //redireciona por url
	}

	public function ativar() {
		$id = \Illuminate\Support\Facades\Request::route('id');
		DB::table('credenciadocategorias')->where('id', $id)->update(['status' => '1']);
		return redirect('/credenciadocategoria/listar')->withInput(); //redireciona por url
	}
}
