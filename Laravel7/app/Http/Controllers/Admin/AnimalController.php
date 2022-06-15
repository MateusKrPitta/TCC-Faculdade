<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Animal; //Adicionado por Cezar
use App\Http\Requests\AnimalRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario;

class AnimalController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        return view('admin.animal.cadastrar')->with('id_usuario', auth()->user()->id);
    }

    public function gravar(AnimalRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Animal::create($dados);
        return redirect('/animal/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $animal = DB::select('select * from animals where id = ?', [$id]);
        return view('admin.animal.editar')->with('animal', $animal);
    }

    public function atualizar(AnimalRequest $request) {
        $dados = Request::all();
        $animal = Animal::find($dados['id']);
        $animal->nome = $dados['nome'];
        $animal->numero = $dados['numero'];
        $animal->pai = $dados['pai'];
        $animal->mae = $dados['mae'];
        $animal->nascimento = $dados['nascimento'];
        $animal->peso = $dados['peso'];
        $animal->sexo = $dados['sexo'];
        $animal->save();
        return redirect('/animal/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $animals = DB::table('animals')
                ->where('empresa_id', Usuario::empresa())
                ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Nome', 'width' => 6],
            ['label' => 'Número', 'width' => 1],
            ['label' => 'Pai', 'width' => 6],
            ['label' => 'Mãe', 'width' => 6],
            ['label' => 'Data Nascimento', 'width' => 2],
            ['label' => 'Sexo', 'width' => 1],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 2, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.animal.listar', compact('animals', 'cabecalho', 'config'));
    }

    public function listarfiltro(Request $request, Animal $animal) {
        $dadosFiltro = Request::all();
        $animals = $animal->filtro($dadosFiltro, $this->linhasNaPagina);
        return view('admin.animal.listar', compact('animals'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $animal = Animal::find($id);
        if ($animal) {
            $animal->delete();
        }
        return redirect('/animal/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('animals')->where('id', $id)->update(['status' => '0']);
        return redirect('/animal/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('animals')->where('id', $id)->update(['status' => '1']);
        return redirect('/animal/listar')->withInput(); //redireciona por url
    }

    public function ficha() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $inseminacao = Animal::leftJoin('inseminacaos', 'animals.id', '=', 'inseminacaos.animal_id')
                ->leftJoin('gestacaos', 'inseminacaos.id', '=', 'gestacaos.inseminacao_id')
                ->leftJoin('partos', 'inseminacaos.id', '=', 'partos.inseminacao_id')
                ->select('inseminacaos.id as inseminacao_id',
                        'animals.id as animal_id',
                        'datainseminacao',
                        'turno',
                        'touro',
                        'inseminador',
                        'status_inseminacao',
                        'animals.nome as nome',
                        'animals.numero as numero',
                        'nascimento',
                        'pai',
                        'mae',
                        'peso',
                        'sexo',
                        'animals.status as animal_status',
                        'gestacaos.id as gestacao_id',
                        'dataconfirmacao',
                        'examinador',
                        'status_gestacao',
                        'partos.id as parto_id',
                        'dataparto',
                        'acompanhante',
                        'status_parto',
                        'filhote_id')
                ->where('animals.id', $id)
                ->orderBy('datainseminacao', 'desc')
                ->get();
        $animais = DB::table('animals')
                ->where('empresa_id', Usuario::empresa())
                ->get();
        $vacinas = DB::table('vacinacaos')
                ->leftJoin('users', 'vacinacaos.usuario_id', '=', 'users.id')
                ->leftJoin('vacinas', 'vacinacaos.vacina_id', '=', 'vacinas.id')
                ->where('vacinacaos.empresa_id', Usuario::empresa())
                ->where('vacinacaos.animal_id', $id)
                ->get();
        $totalvacinas = DB::table('vacinacaos')
                ->leftJoin('users', 'vacinacaos.usuario_id', '=', 'users.id')
                ->leftJoin('vacinas', 'vacinacaos.vacina_id', '=', 'vacinas.id')
                ->where('vacinacaos.empresa_id', Usuario::empresa())
                ->where('vacinacaos.animal_id', $id)
                ->count();
        $producaos = DB::table('producaos')
                ->where('empresa_id', Usuario::empresa())
                ->where('animal_id', $id)
                ->orderBy('data_producao', 'desc')
                ->limit(5)
                ->get();
        $mediaproducao = DB::table('producaos')
                ->where('empresa_id', Usuario::empresa())
                ->where('animal_id', $id)
                ->avg('quantidade');
        $mediaproducao = number_format($mediaproducao, 2, ',', '.');
        return view('admin.animal.ficha')->with('inseminacao', $inseminacao)
                        ->with('mediaproducao', $mediaproducao)
                        ->with('totalvacinas', $totalvacinas)
                        ->with('animais', $animais)
                        ->with('vacinas', $vacinas)
                        ->with('producaos', $producaos);
    }

    public static function baixamensal() {
        $ummesatras = Carbon::now('America/Campo_Grande')->addDay(-30); //Pega a data atual e subtrai 30 dias
        return DB::table('animals')->where('status', 0)->where('updated_at', '>', $ummesatras)->count(); //Busca no banco e conta a quantidade de resultados
    }

    public static function novosmensal() {
        $ummesatras = Carbon::now('America/Campo_Grande')->addDay(-30); //Pega a data atual e subtrai 30 dias
        return DB::table('animals')->where('status', 1)->where('updated_at', '>', $ummesatras)->count(); //Busca no banco e conta a quantidade de resultados
    }

}
