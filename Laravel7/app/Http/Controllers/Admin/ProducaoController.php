<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Animal; //Adicionado por Cezar
use App\Producao; //Adicionado por Cezar
use App\Http\Requests\ProducaoRequest; //Adicionado por Cezar
use App\Usuario;

class ProducaoController extends Controller {

    private $linhasNaPagina = 7;

    public function cadastrar() {
        $configuracao = $configuracao = DB::table('configuracaos')
                ->where('empresa_id', Usuario::empresa())
                ->first();
        $listadeanimais = DB::table('animals')
                        ->select('animals.id as animal_id', 'animals.nome as animal_nome', 'animals.status as animal_status')
                        ->where('animals.peso', '>', $configuracao->pesominimoparainseminacao)
                        ->where('animals.nascimento', '<', date('d/m/Y', strtotime('-' . $configuracao->mesesparaprimeirainseminacao . ' months', strtotime(today()))))
                        ->where('sexo', 'F')
                        ->where('status', '1')
                        ->orderBy('animal_nome', 'asc')
                        ->get()->toArray();
        return view('admin.producao.cadastrar')
                        ->with('listadeanimais', $listadeanimais)
                        ->with('usuario_id', auth()->user()->id);
    }

    public function gravar(ProducaoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Producao::create($dados);
        return redirect('/producao/cadastrar')->withInput();
    }

    public function cadastrargrupo() {
        return view('admin.producao.cadastrargrupo')
                        ->with('usuario_id', auth()->user()->id);
    }

    public function gravargrupo(ProducaoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        $animais = DB::table('animals')->select('animals.id as animal_id')
                        ->where('sexo', 'F')
                        ->where('status', '1')
                        ->get()->toArray();
        $quantidadeanimais = DB::table('animals')
                ->select('animals.id as animal_id')
                ->where('sexo', 'F')
                ->where('status', '1')
                ->count();
        $divisao = $dados['quantidade'] / $quantidadeanimais;
        DB::beginTransaction();
        foreach ($animais as $animal) {
            DB::table('producaos')->insert([
                'empresa_id' => $dados['empresa_id'],
                'animal_id' => $animal->animal_id,
                'data_producao' => $dados['data_producao'],
                'hora_producao' => $dados['hora_producao'],
                'quantidade' => $divisao,
                'usuario_id' => $dados['usuario_id']
            ]);
        }
        DB::commit();
        return redirect('/producao/cadastrargrupo')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $producao = DB::table('producaos')
                ->where('id', $id)
                ->first();
        $listadeanimais = DB::table('animals')
                        ->select('animals.id as animal_id',
                                'animals.nome as animal_nome',
                                'animals.status as animal_status')
                        ->where('sexo', 'F')
                        ->where('status', '1')
                        ->orderBy('animal_nome', 'asc')
                        ->get()->toArray();
        return view('admin.producao.editar')
                        ->with('producao', $producao)
                        ->with('listadeanimais', $listadeanimais);
    }

    public function atualizar(ProducaoRequest $request) {
        $dados = Request::all();
        $producao = Producao::find($dados['id']);
        $producao->empresa_id = Usuario::empresa();
        $producao->usuario_id = \Illuminate\Support\Facades\Auth::user()->id;
        $producao->animal_id = $dados['animal_id'];
        $producao->data_producao = $dados['data_producao'];
        $producao->hora_producao = $dados['hora_producao'];
        $producao->quantidade = $dados['quantidade'];
        $producao->save();
        return redirect('/producao/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $listaproducao = DB::table('producaos')
                ->leftJoin('animals', 'producaos.animal_id', '=', 'animals.id')
                ->where('producaos.empresa_id', Usuario::empresa())
                ->select('producaos.id as producao_id',
                        'animals.nome as nome',
                        'producaos.data_producao as data_producao',
                        'producaos.hora_producao as hora_producao',
                        'producaos.quantidade as quantidade',
                        'producaos.usuario_id as usuario_id')
                ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Nome do Animal', 'width' => 10],
            ['label' => 'Data', 'width' => 3],
            ['label' => 'Hora', 'width' => 3],
            ['label' => 'Quantidade de Leite(Litros)', 'width' => 3],
            ['label' => 'Ações', 'width' => 2, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.producao.listar', compact('listaproducao', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $producao = Producao::find($id);
        if ($producao) {
            $producao->delete();
        }
        return redirect('/producao/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('producaos')->where('id', $id)->update(['status' => '0']);
        return redirect('/producao/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('producaos')->where('id', $id)->update(['status' => '1']);
        return redirect('/producao/listar')->withInput(); //redireciona por url
    }

    public static function producaododia() {
        return DB::table('producaos')->where('data_producao', '=', date('Y-m-d'))->sum('quantidade');
    }

//Fim da Classe
}
