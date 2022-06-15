<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Contratoconvenio; //Adicionado por Cezar
use App\Http\Requests\ContratoconvenioRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use App\Conveniado;
use App\Plano;
use App\Cliente;
use App\Contasareceber;
use App\Formadepagamento;

class ContratoconvenioController extends Controller {

    private $linhasNaPagina = 7;

    public static function totalContratos() {
        $total = Contratoconvenio::all()
                ->where('status', '=', 1)
                ->where('empresa_id', '=', Usuario::empresa())
                ->count();
        return $total;
    }

    public function cadastrar() {
        $conveniados = Conveniado::where('empresa_id', Usuario::empresa())
                        ->where('titular_id', '=', null)
                        ->orderBy('nome')->get();
        $planos = Plano::where('empresa_id', Usuario::empresa())->get();
        $formadepagamentos = Formadepagamento::where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                        ->where('status', 1)
                        ->orderBy('nome')->get();
        return view('admin.contratoconvenio.cadastrar')->with('conveniados', $conveniados)->with('planos', $planos)->with('formadepagamentos', $formadepagamentos);
    }

    public function cadastrar2() {
        $id = Request::route('id');
        $conveniados = Conveniado::where('empresa_id', Usuario::empresa())
                        ->where('titular_id', '=', null)
                        ->where('id', '=', $id)->get();
        $planos = Plano::where('empresa_id', Usuario::empresa())
                        ->orderBy('nome')->orderBy('valor')->get();
        $formadepagamentos = Formadepagamento::where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                        ->where('status', 1)
                        ->orderBy('nome')->get();
        return view('admin.contratoconvenio.cadastrar2')->with('conveniados', $conveniados)->with('planos', $planos)->with('formadepagamentos', $formadepagamentos)->with('id', $id);
    }

    public function gravar(ContratoconvenioRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        $dados['valor'] = Plano::find($dados['plano_id'])->valor;
        if ($dados['id'] > 0) {
            $conveniado1 = Conveniado::find($dados['id']);
            $conveniado1->status = 3;
            $conveniado1->save();
            DB::table('conveniados')->where('titular_id', '=', $dados['id'])->update(['status' => 3]);
        }
        Contratoconvenio::create($dados);
        if ($dados['conveniado'] == 1)
            return redirect('/conveniado/listar');
        else
            return redirect('/contratoconvenio/cadastrar')->withInput();
    }

    public function editar() {
        $conveniados = Conveniado::where('empresa_id', Usuario::empresa())->orderBy('nome')->get();
        $planos = Plano::where('empresa_id', Usuario::empresa())->get();
        $id = Request::route('id');
        $contratoconvenio = DB::select('select * from contratoconvenios where id = ?', [$id]);
        $formadepagamentos = Formadepagamento::where('empresa_id', Usuario::empresa())->get();
        return view('admin.contratoconvenio.editar')->with('conveniados', $conveniados)->with('planos', $planos)->with('contratoconvenio', $contratoconvenio)->with('formadepagamentos', $formadepagamentos);
    }

    public function atualizar() {
        $dados = Request::all();
        $contratoconvenio = Contratoconvenio::find($dados['id']);
        $contratoconvenio->conveniado_id = $dados['conveniado_id'];
        $contratoconvenio->plano_id = $dados['plano_id'];
        $contratoconvenio->valor = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor
        $contratoconvenio->formadepagamento_id = $dados['formadepagamento_id'];
        $contratoconvenio->datadocontrato = $dados['datadocontrato'];
        //$contratoconvenio->status = $dados['status'];
        $contratoconvenio->save();
        return redirect('/contratoconvenio/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $contratoconvenios = DB::table('contratoconvenios')
                ->orderBy('contratoconvenios.updated_at', 'desc')
                ->where('contratoconvenios.empresa_id', '=', Usuario::empresa())
                ->leftJoin('planos', 'contratoconvenios.plano_id', '=', 'planos.id')
                ->leftJoin('conveniados', 'contratoconvenios.conveniado_id', '=', 'conveniados.id')
                ->select('contratoconvenios.id as id',
                        'contratoconvenios.empresa_id as empresa_id',
                        'contratoconvenios.plano_id as plano_id',
                        'contratoconvenios.conveniado_id as conveniado_id',
                        'contratoconvenios.datadocontrato as datadocontrato',
                        'contratoconvenios.valor as valor',
                        'contratoconvenios.status as status',
                        'conveniados.nome as conveniado_nome',
                        'conveniados.cpfcnpj as conveniado_cpf',
                        'conveniados.rgie as conveniado_rg',
                        'conveniados.nascimento as conveniado_nascimento',
                        'conveniados.tel1 as conveniado_tel1',
                        'conveniados.sexo as conveniado_sexo',
                        'conveniados.cidade as conveniado_cidade',
                        'conveniados.estado as conveniado_estado',
                        'conveniados.status as conveniado_status',
                        'planos.nome as plano_nome',
                        'planos.valor as plano_valor',
                        'planos.status as plano_status')
                ->get();

        $contratoplanos = DB::table('planos')
                ->where('planos.empresa_id', '=', Usuario::empresa())
                ->orderBy('planos.nome')
                ->get();
        foreach ($contratoplanos as $plano) {
            $soma = DB::table('contratoconvenios')
                    ->where('contratoconvenios.empresa_id', '=', Usuario::empresa())
                    ->where('contratoconvenios.plano_id', '=', $plano->id)
                    ->orderBy('contratoconvenios.datadocontrato')
                    ->count();
            $plano->soma = $soma;
        }
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Conveniado', 'width' => 10],
            ['label' => 'Plano', 'width' => 10],
            ['label' => 'Valor', 'width' => 2],
            ['label' => 'Data', 'width' => 2],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 1, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, ['orderable' => false], ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.contratoconvenio.listar', compact('contratoconvenios', 'contratoplanos', 'cabecalho', 'config'));
    }

    public function listar2() {
        $contratos = DB::table('contratoconvenios')
                ->where('contratoconvenios.empresa_id', '=', Usuario::empresa())
                ->leftJoin('planos', 'contratoconvenios.plano_id', '=', 'planos.id')
                ->leftJoin('conveniados', 'contratoconvenios.conveniado_id', '=', 'conveniados.id')
                ->leftJoin('formadepagamentos', 'contratoconvenios.formadepagamento_id', '=', 'formadepagamentos.id')
                ->select(
                        'conveniados.nome as conveniado_nome',
                        'conveniados.nascimento as conveniado_nascimento',
                        'conveniados.sexo as conveniado_sexo',
                        'conveniados.cidade as conveniado_cidade',
                        'planos.nome as plano_nome',
                        'contratoconvenios.valor as valor',
                        'formadepagamentos.nome as formadepagamento_nome',
                        'contratoconvenios.datadocontrato as datadocontrato',
                        'contratoconvenios.status as status')
                ->get();

        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Titular', 'width' => 10],
            ['label' => 'Nascimento', 'width' => 2],
            ['label' => 'Sexo', 'width' => 1],
            ['label' => 'Cidade', 'width' => 2],
            ['label' => 'Plano Contratado', 'width' => 2],
            ['label' => 'Valor Pago', 'width' => 2],
            ['label' => 'Forma de Pagamento', 'width' => 2],
            ['label' => 'Data', 'width' => 2],
            ['label' => 'Status', 'width' => 1],
        ];
        $config = [
            'order' => [[7, 'desc']],
            'columns' => [null, null, null, null, null, null, null, null, null],
        ];
        return view('admin.contratoconvenio.listar2', compact('contratos', 'cabecalho', 'config'));
    }

    public function assinarcontrato() {
        $id = Request::route('id');
        $conveniado1 = Conveniado::find($id);
        //Inicio Inserir no contas a receber
        $cliente2 = DB::table('clientes')
                        ->where('empresa_id', Usuario::empresa())
                        ->where('cpfcnpj', '=', $conveniado1->cpfcnpj)->get();
        if (count($cliente2) == 0) { //Cria o Cliente se não existir no cadastro
            $dados['empresa_id'] = $conveniado1['empresa_id'];
            $dados['nome'] = $conveniado1['nome'];
            $dados['cpfcnpj'] = $conveniado1['cpfcnpj'];
            $dados['rgie'] = $conveniado1['rgie'];
            $dados['nascimento'] = $conveniado1['nascimento'];
            $dados['tel1'] = $conveniado1['tel1'];
            $dados['tel2'] = $conveniado1['tel2'];
            $dados['sexo'] = $conveniado1['sexo'];
            $dados['logradouro'] = $conveniado1['logradouro'];
            $dados['numero'] = $conveniado1['numero'];
            $dados['bairro'] = $conveniado1['bairro'];
            $dados['cidade'] = $conveniado1['cidade'];
            $dados['estado'] = $conveniado1['estado'];
            $dados['status'] = 1;
            Cliente::create($dados);
        }
        $cliente1 = DB::table('clientes')
                        ->where('empresa_id', Usuario::empresa())
                        ->where('cpfcnpj', '=', $conveniado1->cpfcnpj)->get();
        //Verifica se existe um contrato
        $verificacontrato = DB::table('contratoconvenios')
                ->where('empresa_id', Usuario::empresa())
                ->where('conveniado_id', $id)
                ->count();
        if ($verificacontrato > 0) { //Verifica se existe um contrato
            $contrato1 = DB::table('contratoconvenios')
                    ->leftJoin('formadepagamentos', 'contratoconvenios.formadepagamento_id', '=', 'formadepagamentos.id')
                    ->where('contratoconvenios.empresa_id', Usuario::empresa())
                    ->where('contratoconvenios.conveniado_id', $id)
                    ->select('contratoconvenios.id as id',
                            'contratoconvenios.empresa_id as empresa_id',
                            'contratoconvenios.plano_id as plano_id',
                            'contratoconvenios.conveniado_id as conveniado_id',
                            'contratoconvenios.datadocontrato as datadocontrato',
                            'contratoconvenios.valor as valor',
                            'contratoconvenios.formadepagamento_id as formadepagamento_id',
                            'contratoconvenios.status as status',
                            'formadepagamentos.parcela as parcela')
                    ->orderBy('contratoconvenios.id', 'desc')
                    ->get();
            // **Exclui o contas a receber antigo e cria um novo, não verifica se foi pago
            DB::table('contratoconvenios')->where('id', '=', $contrato1[0]->id)->update(['contasareceber_id' => null]);
            DB::table('contasarecebers')->where('descricao', '=', 'Convênio - Contrato nº ' . $contrato1[0]->id)->delete();
            // **
            $valorparcela = $contrato1[0]->valor / $contrato1[0]->parcela;

            $dados1['empresa_id'] = $conveniado1['empresa_id'];
            $dados1['cliente_id'] = $cliente1[0]->id;
            $dados1['descricao'] = 'Convênio - Contrato nº ' . $contrato1[0]->id;
            $dados1['valor'] = $valorparcela;
            $dados1['formadepagamento_id'] = $contrato1[0]->formadepagamento_id;
            $dados1['vencimento'] = date('Y-m-d');
            $dados1['pagamento'] = null;
            $dados1['status'] = 1;
            $dados1['observacao'] = 'Convênio - Contrato nº ' . $contrato1[0]->id;
            $contasareceber = Contasareceber::create($dados1);
            if ($contrato1[0]->parcela > 1) {
                for ($i = 1; $i < $contrato1[0]->parcela; $i++) {
                    $datavencimento = $i * 30;
                    $dados1['vencimento'] = date('Y-m-d', strtotime("+ " . $datavencimento . " days"));
                    Contasareceber::create($dados1);
                }
            }
            //Fim Contas a receber
            $conveniado1->status = 4;
            $conveniado1->save();
            DB::table('contratoconvenios')->where('id', '=', $contrato1[0]->id)->update(['status' => 1, 'contasareceber_id' => $contasareceber->id]);
            DB::table('conveniados')->where('titular_id', '=', $id)->update(['status' => 4]);  //Atualiza dependentes
            return redirect('/conveniado/listar');
        } else {
            $conveniado1->status = 2;
            $conveniado1->save();
            DB::table('conveniados')->where('titular_id', '=', $id)->update(['status' => 2]);
            return redirect('/conveniado/listar');
        }
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $contratoconvenio = Contratoconvenio::find($id);
        // **Exclui o contas a receber antigo e cria um novo, não verifica se foi pago
        if (Contasareceber::where('id', '=', $contratoconvenio->contasareceber_id)->count() > 0) {
            $contavelha = Contasareceber::find($contratoconvenio->contasareceber_id);
            $contavelha->delete();
        }
        // **
        if ($contratoconvenio) {
            $contratoconvenio->delete();
        }
        return redirect('/contratoconvenio/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $contrato = Contratoconvenio::find($id);
        $conveniado_id = $contrato->conveniado_id;
        //Bloqueia o Contrato
        DB::table('contratoconvenios')->where('id', $id)->update(['status' => '0']);
        //Bloqueia o Conveniado
        ConveniadoController::bloqueiaTitularDependente( $conveniado_id );
        return redirect('/contratoconvenio/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('contratoconvenios')->where('id', $id)->update(['status' => '1']);
        return redirect('/contratoconvenio/listar')->withInput(); //redireciona por url
    }

    public function imprimircontrato() {
        $id = Request::route('id');

        $contratoconvenio = DB::table('contratoconvenios')
                ->orderBy('contratoconvenios.datadocontrato')
                ->where('contratoconvenios.id', '=', $id)
                ->leftJoin('planos', 'contratoconvenios.plano_id', '=', 'planos.id')
                ->leftJoin('formadepagamentos', 'contratoconvenios.formadepagamento_id', '=', 'formadepagamentos.id')
                ->leftJoin('conveniados', 'contratoconvenios.conveniado_id', '=', 'conveniados.id')
                ->select('contratoconvenios.id as id',
                        'contratoconvenios.empresa_id as empresa_id',
                        'contratoconvenios.plano_id as plano_id',
                        'contratoconvenios.conveniado_id as conveniado_id',
                        'contratoconvenios.datadocontrato as datadocontrato',
                        'contratoconvenios.valor as valor',
                        'contratoconvenios.status as status',
                        'contratoconvenios.usuario_id as contratoconvenios_usuario_id',
                        'conveniados.id as conveniado_id',
                        'conveniados.nome as conveniado_nome',
                        'conveniados.cpfcnpj as conveniado_cpf',
                        'conveniados.rgie as conveniado_rg',
                        'conveniados.nascimento as conveniado_nascimento',
                        'conveniados.tel1 as conveniado_tel1',
                        'conveniados.sexo as conveniado_sexo',
                        'conveniados.logradouro as conveniado_endereco',
                        'conveniados.numero as conveniado_numero',
                        'conveniados.bairro as conveniado_bairro',
                        'conveniados.cidade as conveniado_cidade',
                        'conveniados.estado as conveniado_estado',
                        'conveniados.cep as conveniado_cep',
                        'conveniados.status as conveniado_status',
                        'conveniados.observacao as conveniado_observacao',
                        'conveniados.email as conveniado_email',
                        'conveniados.usuario_id as conveniado_usuario_id',
                        'planos.nome as plano_nome',
                        'planos.valor as plano_valor',
                        'planos.status as plano_status',
                        'formadepagamentos.nome as formadepagamento_nome',
                        'formadepagamentos.parcela as formadepagamento_parcela')
                ->get();

        $dependentes = DB::table('conveniados')
                        ->leftJoin('parentescos', 'conveniados.parentesco_id', '=', 'parentescos.id')
                        ->leftJoin('estadocivils', 'conveniados.estadocivil_id', '=', 'estadocivils.id')
                        ->where('conveniados.empresa_id', Usuario::empresa())
                        ->where('conveniados.titular_id', '=', $contratoconvenio[0]->conveniado_id)
                        ->select('conveniados.id as id',
                                'conveniados.nome as nome',
                                'conveniados.cpfcnpj as cpfcnpj',
                                'conveniados.rgie as rgie',
                                'conveniados.nascimento as nascimento',
                                'conveniados.tel1 as conveniado_tel1',
                                'conveniados.sexo as sexo',
                                'conveniados.observacao as observacao',
                                'parentescos.nome as parentesco_nome',
                                'estadocivils.nome as estadocivil_nome')
                        ->orderBy('conveniados.nome')->get();

        $administrativo = Usuario::where('empresa_id', Usuario::empresa())
                ->where('id', '=', $contratoconvenio[0]->contratoconvenios_usuario_id)
                ->first();

        $vendedor = DB::table('users')
                ->leftJoin('conveniados', 'users.id', '=', 'conveniados.usuario_id')
                ->where('conveniados.id', '=', $contratoconvenio[0]->conveniado_id)
                ->first();

        return view('admin.contratoconvenio.imprimircontrato')
                        ->with('contratoconvenio', $contratoconvenio)
                        ->with('dependentes', $dependentes)
                        ->with('vendedor', $vendedor)
                        ->with('administrativo', $administrativo);
    }

    public function novoscontratos() {
        $contratoconvenios = DB::table('contratoconvenios')
                ->orderBy('contratoconvenios.updated_at', 'desc')
                ->where('contratoconvenios.empresa_id', '=', Usuario::empresa())
                ->leftJoin('planos', 'contratoconvenios.plano_id', '=', 'planos.id')
                ->leftJoin('conveniados', 'contratoconvenios.conveniado_id', '=', 'conveniados.id')
                ->select('contratoconvenios.id as id',
                        'contratoconvenios.empresa_id as empresa_id',
                        'contratoconvenios.plano_id as plano_id',
                        'contratoconvenios.conveniado_id as conveniado_id',
                        'contratoconvenios.datadocontrato as datadocontrato',
                        'contratoconvenios.valor as valor',
                        'contratoconvenios.status as status',
                        'conveniados.nome as conveniado_nome',
                        'conveniados.cpfcnpj as conveniado_cpf',
                        'conveniados.rgie as conveniado_rg',
                        'conveniados.nascimento as conveniado_nascimento',
                        'conveniados.tel1 as conveniado_tel1',
                        'conveniados.sexo as conveniado_sexo',
                        'conveniados.cidade as conveniado_cidade',
                        'conveniados.estado as conveniado_estado',
                        'conveniados.status as conveniado_status',
                        'planos.nome as plano_nome',
                        'planos.valor as plano_valor',
                        'planos.status as plano_status')
                ->get();

        $contratoplanos = DB::table('planos')
                ->where('planos.empresa_id', '=', Usuario::empresa())
                ->orderBy('planos.nome')
                ->get();
        foreach ($contratoplanos as $plano) {
            $soma = DB::table('contratoconvenios')
                    ->where('contratoconvenios.empresa_id', '=', Usuario::empresa())
                    ->where('contratoconvenios.plano_id', '=', $plano->id)
                    ->orderBy('contratoconvenios.datadocontrato')
                    ->count();
            $plano->soma = $soma;
        }
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Conveniado', 'width' => 10],
            ['label' => 'Plano', 'width' => 10],
            ['label' => 'Valor', 'width' => 2],
            ['label' => 'Data', 'width' => 2],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 1, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, ['orderable' => false], ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.contratoconvenio.novoscontratos', compact('contratoconvenios', 'contratoplanos', 'cabecalho', 'config'));
    }

    public function contratosvencidos() {
        $contratoconvenios = DB::table('contratoconvenios')
                ->orderBy('contratoconvenios.updated_at', 'desc')
                ->where('contratoconvenios.empresa_id', '=', Usuario::empresa())
                ->leftJoin('planos', 'contratoconvenios.plano_id', '=', 'planos.id')
                ->leftJoin('conveniados', 'contratoconvenios.conveniado_id', '=', 'conveniados.id')
                ->select('contratoconvenios.id as id',
                        'contratoconvenios.empresa_id as empresa_id',
                        'contratoconvenios.plano_id as plano_id',
                        'contratoconvenios.conveniado_id as conveniado_id',
                        'contratoconvenios.datadocontrato as datadocontrato',
                        'contratoconvenios.valor as valor',
                        'contratoconvenios.status as status',
                        'conveniados.nome as conveniado_nome',
                        'conveniados.cpfcnpj as conveniado_cpf',
                        'conveniados.rgie as conveniado_rg',
                        'conveniados.nascimento as conveniado_nascimento',
                        'conveniados.tel1 as conveniado_tel1',
                        'conveniados.sexo as conveniado_sexo',
                        'conveniados.cidade as conveniado_cidade',
                        'conveniados.estado as conveniado_estado',
                        'conveniados.status as conveniado_status',
                        'planos.nome as plano_nome',
                        'planos.valor as plano_valor',
                        'planos.status as plano_status')
                ->get();

        $contratoplanos = DB::table('planos')
                ->where('planos.empresa_id', '=', Usuario::empresa())
                ->orderBy('planos.nome')
                ->get();
        foreach ($contratoplanos as $plano) {
            $soma = DB::table('contratoconvenios')
                    ->where('contratoconvenios.empresa_id', '=', Usuario::empresa())
                    ->where('contratoconvenios.plano_id', '=', $plano->id)
                    ->orderBy('contratoconvenios.datadocontrato')
                    ->count();
            $plano->soma = $soma;
        }
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Conveniado', 'width' => 10],
            ['label' => 'Plano', 'width' => 10],
            ['label' => 'Valor', 'width' => 2],
            ['label' => 'Data', 'width' => 2],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 1, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, ['orderable' => false], ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.contratoconvenio.contratosvencidos', compact('contratoconvenios', 'contratoplanos', 'cabecalho', 'config'));
    }

}
