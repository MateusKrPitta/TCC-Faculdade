<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Convenioatendimento; //Adicionado por Cezar
use App\Http\Requests\ConvenioatendimentoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar

class ConvenioatendimentoController extends Controller {

    private $linhasNaPagina = 7;

    public static function atendimentosRealizados() {
        $total = Convenioatendimento::all()
                ->where('status', '=', 1)
                ->where('empresa_id', '=', Usuario::empresa())
                ->count();
        return $total;
    }

    public function cadastrar() {
        $credenciados = DB::table('userscredenciados')
                ->leftJoin('credenciados', 'userscredenciados.credenciado_id', '=', 'credenciados.id')
                ->where('userscredenciados.empresa_id', Usuario::empresa())
                ->where('userscredenciados.user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->where('userscredenciados.status', '1')
                ->where('credenciados.status', '1')
                ->orderBy('credenciados.nome')
                ->get();
        $conveniotipodeatendimentos = DB::table('conveniotipodeatendimentos')
                ->where('empresa_id', Usuario::empresa())
                ->where(['status' => '1'])
                ->orderBy('nome')
                ->get();
        return view('admin.convenioatendimento.cadastrar')
                        ->with('conveniotipodeatendimentos', $conveniotipodeatendimentos)
                        ->with('credenciados', $credenciados)
                        ->with('erro', null);
    }

    public function gravar(ConvenioatendimentoRequest $request) {
        $dados = Request::all();
        $conveniotipodeatendimentos = DB::table('conveniotipodeatendimentos')
            ->where('empresa_id', Usuario::empresa())
            ->where(['status' => '1'])
            ->orderBy('nome')
            ->get();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        $dados['valor'] = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor
        $dados['status'] = 1;
        $conveniado = DB::table('conveniados')
            ->leftJoin('cartaos', 'conveniados.id', '=', 'cartaos.conveniado_id')
            ->where('conveniados.empresa_id', Usuario::empresa())
            ->where('cartaos.numeronocartao', '=', $dados['numeronocartao'])
            ->orWhere('conveniados.cpfcnpj', '=', $dados['numeronocartao'])
            ->get();
        if ($conveniado->count() < 1) {
            $credenciados = DB::table('userscredenciados')
                ->leftJoin('credenciados', 'userscredenciados.credenciado_id', '=', 'credenciados.id')
                ->where('userscredenciados.empresa_id', Usuario::empresa())
                ->where('userscredenciados.user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->where('userscredenciados.status', '1')
                ->where('credenciados.status', '1')
                ->orderBy('credenciados.nome')
                ->get();
            return view('admin.convenioatendimento.cadastrar')
                ->with('conveniotipodeatendimentos', $conveniotipodeatendimentos)
                ->with('credenciados', $credenciados)
                ->with('erro', "Número do Cartão não existe!");
        }
        $dados['conveniado_id'] = $conveniado[0]->conveniado_id;
        Convenioatendimento::create($dados);
        return redirect('/convenioatendimento/cadastrar')
            ->with('conveniotipodeatendimentos', $conveniotipodeatendimentos)
            ->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $convenioatendimento = DB::table('convenioatendimentos')
                ->leftJoin('credenciados', 'convenioatendimentos.credenciado_id', '=', 'credenciados.id')
                ->leftJoin('conveniados', 'convenioatendimentos.conveniado_id', '=', 'conveniados.id')
                ->leftJoin('cartaos', 'conveniados.id', '=', 'cartaos.conveniado_id')
                ->leftJoin('conveniotipodeatendimentos', 'convenioatendimentos.tipodeatendimento', '=', 'conveniotipodeatendimentos.id')
                ->where('convenioatendimentos.empresa_id', Usuario::empresa())
                ->select('convenioatendimentos.id as id',
                        'convenioatendimentos.empresa_id as empresa_id',
                        'convenioatendimentos.credenciado_id as credenciado_id',
                        'convenioatendimentos.valor as valor',
                        'convenioatendimentos.nomedoresponsavel as nomedoresponsavel',
                        'convenioatendimentos.data as data',
                        'convenioatendimentos.observacao as observacao',
                        'convenioatendimentos.status as status',
                        'conveniotipodeatendimentos.id as tipodeatendimento_id',
                        'conveniotipodeatendimentos.nome as tipodeatendimento',
                        'conveniados.id as conveniado_id',
                        'conveniados.titular_id as conveniado_titular_id',
                        'conveniados.nome as conveniado_nome',
                        'cartaos.numeronocartao as cartao_numeronocartao',
                        'credenciados.nome as credenciado_nome'
                )
                ->where('convenioatendimentos.id', $id)
                ->first();
        $credenciados = DB::table('credenciados')
                ->where('empresa_id', Usuario::empresa())
                ->where(['status' => '1'])
                ->orderBy('nome')
                ->get();
        $conveniotipodeatendimentos = DB::table('conveniotipodeatendimentos')
                ->where('empresa_id', Usuario::empresa())
                ->where(['status' => '1'])
                ->orderBy('nome')
                ->get();
        //dd($convenioatendimento);
        return view('admin.convenioatendimento.editar')
                        ->with('convenioatendimento', $convenioatendimento)
                        ->with('conveniotipodeatendimentos', $conveniotipodeatendimentos)
                        ->with('credenciados', $credenciados)
                        ->with('erro', null);
    }

    public function atualizar(ConvenioatendimentoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        $dados['valor'] = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor

        $conveniado = DB::table('conveniados')
                ->leftJoin('cartaos', 'conveniados.id', '=', 'cartaos.conveniado_id')
                ->where('conveniados.empresa_id', Usuario::empresa())
                ->where('cartaos.numeronocartao', '=', $dados['numeronocartao'])
                ->get();
        if ($conveniado->count() < 1) {

            $credenciados = DB::table('credenciados')
                    ->where('empresa_id', Usuario::empresa())
                    ->where(['status' => '1'])
                    ->get();
            return redirect('/convenioatendimento/editar/' . $dados['id'])
                            ->withInput()
                            ->with('credenciados', $credenciados)
                            ->with('erro', "Número do Cartão não existe!");
        }
        $dados['conveniado_id'] = $conveniado[0]->conveniado_id;

        $convenioatendimento = Convenioatendimento::find($dados['id']);
        //$convenioatendimento->numeronocartao = $dados['numeronocartao'];
        $convenioatendimento->conveniado_id = $dados['conveniado_id'];
        $convenioatendimento->data = $dados['data'];
        $convenioatendimento->credenciado_id = $dados['credenciado_id'];
        $convenioatendimento->tipodeatendimento = $dados['tipodeatendimento'];
        $convenioatendimento->valor = $dados['valor'];
        $convenioatendimento->nomedoresponsavel = $dados['nomedoresponsavel'];
        $convenioatendimento->observacao = $dados['observacao'];
        $convenioatendimento->save();
        return redirect('/convenioatendimento/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $convenioatendimentos = DB::table('convenioatendimentos')
                ->leftJoin('credenciados', 'convenioatendimentos.credenciado_id', '=', 'credenciados.id')
                ->leftJoin('conveniados', 'convenioatendimentos.conveniado_id', '=', 'conveniados.id')
                ->leftJoin('conveniotipodeatendimentos', 'convenioatendimentos.tipodeatendimento', '=', 'conveniotipodeatendimentos.id')
                ->where('convenioatendimentos.empresa_id', Usuario::empresa())
                ->select('convenioatendimentos.id as id',
                        'convenioatendimentos.empresa_id as empresa_id',
                        'convenioatendimentos.valor as valor',
                        'convenioatendimentos.nomedoresponsavel as nomedoresponsavel',
                        'convenioatendimentos.data as data',
                        'convenioatendimentos.observacao as observacao',
                        'convenioatendimentos.status as status',
                        'conveniotipodeatendimentos.nome as tipodeatendimento',
                        'conveniados.titular_id as conveniado_titular_id',
                        'conveniados.nome as conveniado_nome',
                        'credenciados.nome as credenciado_nome'
                )
                ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Conveniado', 'width' => 10],
            ['label' => 'Credenciado', 'width' => 10],
            ['label' => 'Tipo de Atendimento', 'width' => 2],
            ['label' => 'Valor', 'width' => 2],
            ['label' => 'Nome do Responsável', 'width' => 4],
            ['label' => 'Data', 'width' => 2],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 2, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'desc']],
            'columns' => [null, null, null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.convenioatendimento.listar', compact('convenioatendimentos', 'cabecalho', 'config'));
    }

    public function relatorio() {
        //Credenciados que o usuario visualiza
        $credenciadosdousuario = DB::table('userscredenciados')
                ->where('userscredenciados.user_id', Usuario::id())
                ->select('credenciado_id')
                ->pluck('userscredenciados.credenciado_id');
        //dd(($credenciadosdousuario));
        $convenioatendimentos = DB::table('convenioatendimentos')
                ->leftJoin('credenciados', 'convenioatendimentos.credenciado_id', '=', 'credenciados.id')
                ->leftJoin('conveniados', 'convenioatendimentos.conveniado_id', '=', 'conveniados.id')
                ->leftJoin('conveniotipodeatendimentos', 'convenioatendimentos.tipodeatendimento', '=', 'conveniotipodeatendimentos.id')
                ->where('convenioatendimentos.empresa_id', Usuario::empresa())
                ->whereIn('convenioatendimentos.credenciado_id', $credenciadosdousuario )
                ->select('convenioatendimentos.id as id',
                        'convenioatendimentos.empresa_id as empresa_id',
                        'convenioatendimentos.valor as valor',
                        'convenioatendimentos.nomedoresponsavel as nomedoresponsavel',
                        'convenioatendimentos.data as data',
                        'convenioatendimentos.observacao as observacao',
                        'convenioatendimentos.status as status',
                        'conveniotipodeatendimentos.nome as tipodeatendimento',
                        'conveniados.titular_id as conveniado_titular_id',
                        'conveniados.nome as conveniado_nome',
                        'credenciados.nome as credenciado_nome'
                )
                ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Conveniado', 'width' => 10],
            ['label' => 'Credenciado', 'width' => 10],
            ['label' => 'Tipo de Atendimento', 'width' => 2],
            ['label' => 'Valor', 'width' => 2],
            ['label' => 'Nome do Responsável', 'width' => 4],
            ['label' => 'Data', 'width' => 2],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 2, 'no-export' => true],
        ];
        $config = [
            'order' => [[5, 'desc']],
            'columns' => [null, null, null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.convenioatendimento.relatorio', compact('convenioatendimentos', 'cabecalho', 'config'));
    }

    public function listarfiltro(Request $request, Convenioatendimento $convenioatendimento) {
        //dd(Request::all());
        $dadosFiltro = Request::all();
        $convenioatendimentos = $convenioatendimento->filtro($dadosFiltro, $this->linhasNaPagina);
        $listaconvenioatendimentos = DB::table('convenioatendimentos')->where('empresa_id', Usuario::empresa())->orderBy('id')->get()->toArray();
        return view('admin.convenioatendimento.listar', compact('convenioatendimentos', 'listaconvenioatendimentos'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $convenioatendimento = Convenioatendimento::find($id);
        if ($convenioatendimento) {
            $convenioatendimento->delete();
        }
        return redirect('/convenioatendimento/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('convenioatendimentos')->where('id', $id)->update(['status' => '0']);
        return redirect('/convenioatendimento/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('convenioatendimentos')->where('id', $id)->update(['status' => '1']);
        return redirect('/convenioatendimento/listar')->withInput(); //redireciona por url
    }

    public function confirmarpagamento() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        //Atualiza o status do convenioatendimento
        DB::table('convenioatendimentos')
                ->where('empresa_id', Usuario::empresa())
                ->where('id', $id)->update(['status' => '1']);
        //Identifica o id da conta a receber
        $contasareceber_id = DB::table('contratoconvenios')
                ->where('contratoconvenios.empresa_id', Usuario::empresa())
                ->where('contratoconvenios.convenioatendimento_id', $id)
                ->orderBy('contratoconvenios.id', 'desc')
                ->get('contasareceber_id');

        // Atualiza a conta a receber
        DB::table('contasarecebers')
                ->where('empresa_id', Usuario::empresa())
                ->where('id', '=', $contasareceber_id[0]->contasareceber_id)
                ->update([
                    'status' => 2,
                    'pagamento' => date(now()),
                    'observacao' => 'Pagamento Realizado pelo módulo Convenio',
                    'usuario_id' => \Illuminate\Support\Facades\Auth::user()->id
        ]);
        //Atualiza os dependentes
        DB::table('convenioatendimentos')->where('titular_id', '=', $id)->update(['status' => 1]);

        return redirect('/convenioatendimento/listar'); //redireciona por url
    }

    public function ficha() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $convenioatendimento = Convenioatendimento::find($id);
        $dependentes = DB::table('convenioatendimentos')
                ->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->where('titular_id', '=', $id)
                ->get();
        return view('admin.convenioatendimento.ficha')->with('convenioatendimento', $convenioatendimento)->with('dependentes', $dependentes);
    }

    public function consultarficha() {
        return view('admin.convenioatendimento.consultarficha')->with('erro', null);
    }

    public function consultarcartao() {
        $dados = Request::all();
        $conveniado = DB::table('conveniados')
                ->leftJoin('cartaos', 'conveniados.id', '=', 'cartaos.conveniado_id')
                ->where('conveniados.empresa_id', Usuario::empresa())
                ->where('cartaos.numeronocartao', '=', $dados['numeronocartao'])
                ->get();
        if ($convenioatendimento->count() < 1)
            return view('admin.convenioatendimento.consultarficha')->with('erro', "Número do Cartão não existe!");
        $dependentes = DB::table('convenioatendimentos')
                ->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->where('titular_id', '=', $convenioatendimento[0]->conveniado_id)
                ->get();
        return view('admin.convenioatendimento.ficha')->with('convenioatendimento', $convenioatendimento[0])->with('dependentes', $dependentes);
    }

}
