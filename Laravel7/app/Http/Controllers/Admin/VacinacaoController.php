<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Vacina; //Adicionado por Cezar
use App\Vacinacao; //Adicionado por Cezar
use App\Animal; //Adicionado por Cezar
use App\Http\Requests\VacinacaoRequest; //Adicionado por Cezar
use App\Usuario;

class VacinacaoController extends Controller {

    //
    public function cadastrar() {
        /*
          $listadeanimais = DB::table('animals')->leftJoin('inseminacaos', 'animals.id', '=', 'inseminacaos.animal_id')
          ->select('animals.id as animal_id', 'animals.nome as animal_nome', 'animals.status as animal_status', 'inseminacaos.id as inseminacao_id')
          ->where('sexo', 'F')
          ->where('status', '1')
          ->get()->toArray();
         */
        $vacinas = Vacina::all()->sort();
        $listadeanimais = Animal::all()->sort();
        return view('admin.vacinacao.cadastrar')->with('usuario_id', auth()->user()->id)->with('vacinas', $vacinas)->with('animais', $listadeanimais);
    }

    public function cadastrargrupo() {
        $vacinas = Vacina::all()->sort();
        return view('admin.vacinacao.cadastrargrupo')->with('usuario_id', auth()->user()->id)->with('vacinas', $vacinas);
    }

    public function gravar(VacinacaoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Vacinacao::create($dados);
        return redirect('/vacinacao/cadastrar')->withInput();
    }

    public function gravargrupo(VacinacaoRequest $request) {  
        $dados = $request->all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        $listadeanimais = DB::table('animals')->leftJoin('vacinacaos', 'animals.id', '=', 'vacinacaos.animal_id')
                        ->select('animals.id as animal_id', 'animals.nome as animal_nome')
                        ->where('animals.status', '1')
                        ->get()->toArray();
        DB::beginTransaction();
        //Processa a lista de animais
        foreach ($listadeanimais as $animal) {
            $resultado = false;
            $dados['animal_id'] = $animal->animal_id;
            $contagem = Vacinacao::where('animal_id', $dados['animal_id'])
                    ->where('vacina_id', $dados['vacina_id'])
                    ->where('animal_id', $dados['animal_id'])
                    //->where('usuario_id', $dados['usuario_id'])
                    ->where('datavacina', $dados['datavacina'])
                    ->count();
            if ($contagem == 0)
                Vacinacao::create($dados); //Adiciona somente se não existir o registro
            $resultado = true;
        }
        //Condição para gravar as transações
        if ($resultado) {
            //Sucesso!
            DB::commit();
        } else {
            //Fail, desfaz as alterações no banco de dados
            DB::rollBack();
        }
        return redirect('/vacinacao/cadastrargrupo')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $vacinacao = DB::select('select * from vacinacaos where id = ?', [$id]);
        return view('admin.vacinacao.editar')->with('vacinacao', $vacinacao);
    }

    public function atualizar(VacinacaoRequest $request) {
        $dados = Request::all();
        DB::table('vacinacaos')->where('id', $dados['id'])->update([
            'nome' => $dados['nome'],
            'numero' => $dados['numero'],
            'pai' => $dados['pai'],
            'mae' => $dados['mae'],
            'peso' => $dados['peso']
        ]);
        return redirect('/vacinacao/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $listadeanimais = DB::table('vacinacaos')->leftJoin('animals', 'vacinacaos.animal_id', '=', 'animals.id')
                ->leftJoin('vacinas', 'vacinacaos.vacina_id', '=', 'vacinas.id')
                ->select('animals.id as animal_id', 'animals.nome as animal_nome', 'vacinacaos.datavacina as datavacina', 'vacinas.nomevacina as vacina_nome')
                ->get()
                ->toArray();
        $cabecalho = [
            ['label' => 'Animal', 'with' =>10],
            ['label' => 'Vacina', 'with' =>10],
            ['label' => 'Data da Vacina', 'with' =>10],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.vacinacao.listar', compact('listadeanimais', 'cabecalho', 'config'));
    }

    public function relatorio() {
        $listadeanimais = DB::table('vacinacaos')->leftJoin('animals', 'vacinacaos.animal_id', '=', 'animals.id')
                        ->leftJoin('vacinas', 'vacinacaos.vacina_id', '=', 'vacinas.id')
                        ->select('animals.id as animal_id', 'animals.nome as animal_nome', 'vacinacaos.datavacina as datavacina', 'vacinas.nomevacina as vacina_nome')
                        ->orderBy('vacina_nome', 'asc')
                        ->get()->toArray();
        return view('admin.vacinacao.relatorio')->with('animais', $listadeanimais);
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $vacinacao = Vacinacao::find($id);
        if($vacinacao) {           
            $vacinacao->delete();
        }
        return redirect('/vacinacao/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('vacinacaos')->where('id', $id)->update(['status' => '0']);
        return redirect('/vacinacao/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('vacinacaos')->where('id', $id)->update(['status' => '1']);
        return redirect('/vacinacao/listar')->withInput(); //redireciona por url
    }

}
