<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Animal; //Adicionado por Cezar
use App\Inseminacao; //Adicionado por Cezar
use App\Http\Controllers\Admin\ConfiguracaoController; //Adicionado por Cezar
use App\Http\Requests\InseminacaoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario;

class InseminacaoController extends Controller {

    //
    public function cadastrar() {
        $configuracao = $configuracao = DB::table('configuracaos')
                ->where('empresa_id', Usuario::empresa())
                ->first();

        $listadeanimais = DB::table('animals')
                        ->leftJoin('inseminacaos', 'animals.id', '=', 'inseminacaos.animal_id')
                        ->select('animals.id as animal_id',
                                'animals.nome as animal_nome',
                                'animals.status as animal_status',
                                'inseminacaos.id as inseminacao_id')
                        ->where('animals.sexo', 'F')
                        ->where('animals.peso', '>', $configuracao->pesominimoparainseminacao)
                        ->where('animals.nascimento', '<', date('Y-m-d', strtotime('-' . $configuracao->mesesparaprimeirainseminacao . ' months', strtotime(today()))))
                        ->where('animals.empresa_id', Usuario::empresa())
                        ->where('animals.status', '1')
                        ->where('status_inseminacao', null)
                        ->orwhere('status_inseminacao', '2')
                        ->get();
        return view('admin.inseminacao.cadastrar')->with('listadeanimais', $listadeanimais)->with('usuario_id', auth()->user()->id);
    }

    public function gravar(InseminacaoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Inseminacao::create($dados);
        return redirect('/inseminacao/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $listadeanimais = DB::table('animals')->leftJoin('inseminacaos', 'animals.id', '=', 'inseminacaos.animal_id')
                        ->select('animals.id as animal_id', 'animals.nome as animal_nome', 'animals.status as animal_status', 'inseminacaos.id as inseminacao_id')
                        ->where('sexo', 'F')
                        ->where('status', '1')
                        ->where('status_inseminacao', null)
                        ->orwhere('status_inseminacao', '2')
                        ->get()->toArray();
        $inseminacao = DB::table('inseminacaos')->where('id', $id)->first();
        return view('admin.inseminacao.editar')
                        ->with('inseminacao', $inseminacao)
                        ->with('listadeanimais', $listadeanimais);
    }

    public function atualizar(InseminacaoRequest $request) {
        $dados = Request::all();
        $inseminacao = Inseminacao::find($dados['id']);
        $inseminacao->empresa_id = Usuario::empresa();
        $inseminacao->usuario_id = \Illuminate\Support\Facades\Auth::user()->id;
        $inseminacao->animal_id = $dados['animal_id'];
        $inseminacao->datainseminacao = $dados['datainseminacao'];
        $inseminacao->turno = $dados['turno'];
        $inseminacao->touro = $dados['touro'];
        $inseminacao->inseminador = $dados['inseminador'];
        $inseminacao->status_inseminacao = $dados['status_inseminacao'];
        $inseminacao->save();
        return redirect('/inseminacao/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $inseminacaos = DB::table('inseminacaos')
                ->leftJoin('animals', 'inseminacaos.animal_id', 'animals.id')
                ->select('inseminacaos.id as id',
                        'inseminacaos.animal_id as animal_id',
                        'animals.nome as nome',
                        'inseminacaos.datainseminacao as datainseminacao',
                        'inseminacaos.turno as turno',
                        'inseminacaos.touro as touro',
                        'inseminacaos.inseminador as inseminador',
                        'inseminacaos.status_inseminacao as status_inseminacao',
                        'inseminacaos.usuario_id as usuario_id')
                ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Animal', 'width' => 10],
            ['label' => 'Data inseminação', 'width' => 3],
            ['label' => 'Turno', 'width' => 3],
            ['label' => 'Touro', 'width' => 3],
            ['label' => 'Inseminador', 'width' => 3],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Parto(Previsão)', 'width' => 3],
            ['label' => 'Ações', 'width' => 2, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, ['orderable' => false], ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.inseminacao.listar', compact('inseminacaos', 'cabecalho', 'config'));
    }

    public function relatorio() {
        //$inseminacao = Inseminacao::Join('animals', 'inseminacaos.animal_id', '=', 'animals.id')->orderBy('datainseminacao', 'desc')->get();
        $inseminacao = Inseminacao::leftJoin('animals', 'inseminacaos.animal_id', '=', 'animals.id')
                        ->leftJoin('gestacaos', 'inseminacaos.id', '=', 'gestacaos.inseminacao_id')
                        ->leftJoin('partos', 'inseminacaos.id', '=', 'partos.inseminacao_id')
                        ->select('inseminacaos.id as inseminacao_id',
                                'inseminacaos.animal_id as animal_id',
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
                                'filhote_id',
                                'acompanhante',
                                'status_parto')
                        ->orderBy('datainseminacao', 'desc')->get();
        //dd($inseminacao);
        return view('admin.inseminacao.relatorio')->with('inseminacao', $inseminacao);
    }

    public function ficha() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        //$inseminacao = Inseminacao::Join('animals', 'inseminacaos.animal_id', '=', 'animals.id')->orderBy('datainseminacao', 'desc')->get();
        /*
          $inseminacao = Inseminacao::leftJoin('animals', 'inseminacaos.animal_id', '=', 'animals.id')
          ->leftJoin('gestacaos', 'inseminacaos.id', '=', 'gestacaos.inseminacao_id')
          ->leftJoin('partos', 'inseminacaos.id', '=', 'partos.inseminacao_id')
          ->select('inseminacaos.id as inseminacao_id', 'inseminacaos.animal_id as animal_id', 'datainseminacao', 'turno', 'touro', 'inseminador', 'status_inseminacao', 'animals.nome as nome', 'animals.numero as numero', 'nascimento', 'pai', 'mae', 'peso', 'sexo', 'animals.status as animal_status', 'gestacaos.id as gestacao_id', 'dataconfirmacao', 'examinador', 'status_gestacao', 'partos.id as parto_id', 'dataparto', 'acompanhante', 'status_parto')
          ->where('animals.id', $id)
          ->orderBy('datainseminacao', 'desc')->get();
         */
        $inseminacao = Animal::leftJoin('inseminacaos', 'animals.id', '=', 'inseminacaos.animal_id')
                        ->leftJoin('gestacaos', 'inseminacaos.id', '=', 'gestacaos.inseminacao_id')
                        ->leftJoin('partos', 'inseminacaos.id', '=', 'partos.inseminacao_id')
                        ->select('inseminacaos.id as inseminacao_id', 'animals.id as animal_id', 'datainseminacao', 'turno', 'touro', 'inseminador', 'status_inseminacao', 'animals.nome as nome', 'animals.numero as numero', 'nascimento', 'pai', 'mae', 'peso', 'sexo', 'animals.status as animal_status', 'gestacaos.id as gestacao_id', 'dataconfirmacao', 'examinador', 'status_gestacao', 'partos.id as parto_id', 'dataparto', 'acompanhante', 'status_parto')
                        ->where('animals.id', $id)
                        ->orderBy('datainseminacao', 'desc')->get();
        //dd($inseminacao);
        return view('admin.inseminacao.ficha')->with('inseminacao', $inseminacao);
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $inseminacao = Inseminacao::find($id);
        if ($inseminacao) {
            $inseminacao->delete();
        }
        return redirect('/inseminacao/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('inseminacaos')->where('id', $id)->update(['status_inseminacao' => '']);
        return redirect('/inseminacao/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('inseminacaos')->where('id', $id)->update(['status_inseminacao' => '1']);
        return redirect('/inseminacao/listar')->withInput(); //redireciona por url
    }

    public static function previsaoParto($id) { //Calcula a data prevista para o parto a partir do ID da inseminacao
        $diasdegestacao = ConfiguracaoController::diasdegestacao();
        $inseminacao = DB::table('inseminacaos')
                ->where('id', $id)
                ->first();
        //dd($inseminacao);
        $time = $inseminacao->datainseminacao;
        $tz = 'America/Campo_Grande';
        $datainseminacao = new Carbon($time, $tz);
        $previsaoparto = $datainseminacao->addDay($diasdegestacao); //retorna a previsao do parto
        return $previsaoparto;
    }

    public static function novosmensal() {
        $ummesatras = Carbon::now('America/Campo_Grande')->addDay(-30); //Pega a data atual e subtrai 30 dias
        return DB::table('inseminacaos')->where('status_inseminacao', 1)->where('updated_at', '>', $ummesatras)->count(); //Busca no banco e conta a quantidade de resultados
    }

    public static function semconfirmacao() {
        return DB::table('inseminacaos')->where('status_inseminacao', 0)->count(); //Busca no banco e conta a quantidade de resultados
    }

    public static function prontoinseminar() {
        return DB::table('animals')->leftJoin('inseminacaos', 'animals.id', '=', 'inseminacaos.animal_id')
                        ->where('sexo', 'F')
                        ->where('status', '1')
                        ->where('status_inseminacao', null)
                        ->orwhere('status_inseminacao', '2')
                        ->count(); //Busca no banco e conta a quantidade de resultados
    }

}
