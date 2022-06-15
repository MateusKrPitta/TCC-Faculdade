<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Conveniado; //Adicionado por Cezar
use App\Http\Requests\ConveniadoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use Maatwebsite\Excel\Facades\Excel; //Adicionado por Cezar - Necessário para exportar em Excel
use App\Exports\ConveniadosExport; //Adicionado por Cezar - Necessário para exportar em Excel
use App\Exports\ConveniadosViewExport; //Adicionado por Cezar - Necessário para exportar em Excel
use App\Convenioconsultacartao;
use App\Plano;

class ConveniadoController extends Controller {

    private $linhasNaPagina = 7;

    public function exportaXLSX() {
        return Excel::download(new ConveniadosExport, 'Conveniados.xlsx');
    }

    public function exportaPDF() {
        return Excel::download(new ConveniadosViewExport, 'Conveniados.pdf');
    }

    public static function totalDeConveniados() {
        $total = Conveniado::all()->where('status', '=', 1)
                ->where('empresa_id', '=', Usuario::empresa())
                ->count();
        return $total;
    }

    public static function novosConveniados() {
        $total = Conveniado::all()->where('status', '=', 1)
                ->where('empresa_id', '=', Usuario::empresa())
                ->where('created_at', '<', date(now()))
                ->where('created_at', '>', date('Y-m-d', strtotime("-7 days")))
                ->count();
        return $total;
    }

    public static function pendentesConveniados() {
        $total = Conveniado::all()
                ->where('status', '<>', 1)
                ->where('empresa_id', '=', Usuario::empresa())
                ->where('status', '<>', 0)
                ->count();
        return $total;
    }

    public static function consultasRealizadas() {
        $total = Conveniado::all()
                ->where('status', '=', 1)
                ->where('empresa_id', '=', Usuario::empresa())
                ->count();
        return $total;
    }

    public function cadastrar() {
        $titular_id = \Illuminate\Support\Facades\Request::route('id');
        $estadocivils = DB::table('estadocivils')
                ->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', 1)
                ->get();
        $parentescos = DB::table('parentescos')
                ->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', 1)
                ->get();
        return view('admin.conveniado.cadastrar')
                        ->with('titular_id', $titular_id)
                        ->with('parentescos', $parentescos)
                        ->with('estadocivils', $estadocivils);
    }

    public function gravar(ConveniadoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        $dados['status'] = 2;
        $conveniado = Conveniado::create($dados);
        if (isset($conveniado->titular_id))
            $id = $conveniado->titular_id;
        else
            $id = $conveniado->id;
        return redirect('/conveniado/cadastrar/' . $id)->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $conveniado = DB::select('select * from conveniados where id = ?', [$id]);
        $estadocivils = DB::table('estadocivils')
                ->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', 1)
                ->get();
        $parentescos = DB::table('parentescos')
                ->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', 1)
                ->get();
        $titular_id = $conveniado[0]->titular_id;
        return view('admin.conveniado.editar')
                        ->with('conveniado', $conveniado)
                        ->with('titular_id', $titular_id)
                        ->with('parentescos', $parentescos)
                        ->with('estadocivils', $estadocivils);
    }

    public function atualizar(ConveniadoRequest $request) {
        $dados = Request::all();
        $conveniado = Conveniado::find($dados['id']);
        $conveniado->nome = $dados['nome'];
        $conveniado->cpfcnpj = $dados['cpfcnpj'];
        $conveniado->rgie = $dados['rgie'];
        $conveniado->nascimento = $dados['nascimento'];
        $conveniado->sexo = $dados['sexo'];
        $conveniado->estadocivil_id = $dados['estadocivil_id'];
        $conveniado->parentesco_id = $dados['parentesco_id'];
        $conveniado->tel1 = $dados['tel1'];
        $conveniado->tel2 = $dados['tel2'];
        $conveniado->logradouro = $dados['logradouro'];
        $conveniado->numero = $dados['numero'];
        $conveniado->bairro = $dados['bairro'];
        $conveniado->complemento = $dados['complemento'];
        $conveniado->cidade = $dados['cidade'];
        $conveniado->estado = $dados['estado'];
        $conveniado->cep = $dados['cep'];
        $conveniado->email = $dados['email'];
        $conveniado->status = $dados['status'];
        $conveniado->imagem = $dados['imagem'];
        $conveniado->save();
        return redirect('/conveniado/listar')->withInput(); //redireciona por url
    }

    public function imprimelista() {
        //Sessão

        if (!session()->has('conveniado'))
            session(['conveniado' => ['ordem' => 'data']]);


        $conveniados = DB::table('conveniados')
                ->leftJoin('cartaos', 'conveniados.id', '=', 'cartaos.conveniado_id')
                ->where('conveniados.empresa_id', Usuario::empresa())
                ->where('cartaos.numeronocartao', '>', 0)
                ->select('conveniados.id as id',
                        'conveniados.empresa_id as empresa_id',
                        'conveniados.titular_id as titular_id',
                        'conveniados.nome as nome',
                        'conveniados.cpfcnpj as cpfcnpj',
                        'conveniados.rgie as rgie',
                        'conveniados.nascimento as nascimento',
                        'conveniados.tel1 as tel1',
                        'conveniados.tel2 as tel2',
                        'conveniados.sexo as sexo',
                        'conveniados.logradouro as logradouro',
                        'conveniados.numero as numero',
                        'conveniados.bairro as bairro',
                        'conveniados.complemento as complemento',
                        'conveniados.cidade as cidade',
                        'conveniados.estado as estado',
                        'conveniados.cep as cep',
                        'conveniados.status as status',
                        'conveniados.observacao as observacao',
                        'conveniados.usuario_id as usuario_id',
                        'cartaos.conveniado_id as conveniado_id',
                        'cartaos.nomenocartao as nomenocartao',
                        'cartaos.numeronocartao as numeronocartao',
                        'cartaos.datadeemissao as datadeemissao',
                        'cartaos.datadevalidade as datadevalidade',
                        'cartaos.status as cartao_status',
                        'cartaos.usuario_id as cartao_usuario_id')
                ->orderBy('cartaos.numeronocartao', 'desc')
                ->orderBy('conveniados.id', 'desc')
                ->get();
        $listaconveniados = DB::table('conveniados')
                ->where('empresa_id', Usuario::empresa())
                ->orderBy('id')
                ->get();
        return view('admin.conveniado.imprimelista', compact('conveniados', 'listaconveniados'));
    }

    public function historicoconsultas() {
        $consultas = DB::table('convenioconsultacartaos')
                ->leftJoin('users', 'convenioconsultacartaos.usuario_id', '=', 'users.id')
                ->leftJoin('conveniados', 'convenioconsultacartaos.conveniado_id', '=', 'conveniados.id')
                ->leftJoin('credenciados', 'convenioconsultacartaos.credenciado_id', '=', 'credenciados.id')
                ->where('convenioconsultacartaos.empresa_id', Usuario::empresa())
                ->select('convenioconsultacartaos.created_at as datahora',
                        'credenciados.nome as credenciado',
                        'users.name as usuario',
                        'convenioconsultacartaos.numero as numero',
                        'conveniados.nome as conveniado')
                ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Data Hora', 'width' => 10],
            ['label' => 'Credenciado', 'width' => 10],
            ['label' => 'Usuário', 'width' => 10],
            ['label' => 'Registro Consultado', 'width' => 10],
            ['label' => 'Conveniado', 'width' => 10],
        ];
        $config = [
            'order' => [[0, 'desc']],
            'columns' => [null, null, null, null, null],
        ];
        return view('admin.conveniado.historicoconsultas', compact('consultas', 'cabecalho', 'config'));
    }

    public function listar() {
        $conveniados = DB::table('conveniados')
                ->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->get();
        $listaconveniados = DB::table('conveniados')->where('empresa_id', Usuario::empresa())->orderBy('id')->get()->toArray();

        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Titular', 'width' => 10],
            ['label' => 'Telefone', 'width' => 3],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 4, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.conveniado.listar', compact('conveniados', 'listaconveniados', 'cabecalho', 'config'));
    }

    public function listar2() {
        $conveniados = DB::table('conveniados')
                ->leftJoin('cartaos', 'conveniados.id', '=', 'cartaos.conveniado_id')
                ->where('conveniados.empresa_id', Usuario::empresa())
                ->where('conveniados.status', 1)
                ->where('cartaos.status', 1)
                ->where('cartaos.numeronocartao', '>', 0)
                ->select(
                        'conveniados.id as id',
                        'conveniados.nome as nome',
                        'conveniados.nome as 0',
                        'conveniados.titular_id as titular',
                        'conveniados.titular_id as 1',
                        'conveniados.tel1 as tel1',
                        'conveniados.tel1 as 2',
                        'conveniados.nascimento as nascimento',
                        'conveniados.nascimento as 3',
                        'cartaos.datadevalidade as datadevalidade',
                        'cartaos.datadevalidade as 4',
                        'cartaos.numeronocartao as numeronocartao',
                        'cartaos.numeronocartao as 5',
                        'conveniados.id as 6')
                ->orderBy('id', 'desc')
                ->get();

        //Corrige informações para exibição
        foreach ($conveniados as $conveniado) {
            if ($conveniado->titular > 0)
                $conveniado->{1} = Conveniado::find($conveniado->titular)->nome;
            else
                $conveniado->titular = "";
            $conveniado->{3} = date('d/m/Y', strtotime($conveniado->{3}));
            $conveniado->{4} = date('d/m/Y', strtotime($conveniado->{4}));
            $conveniado->{6} = '<a href="/conveniado/editar/' . $conveniado->{6} . '" title="Editar as Informações do Conveniado"><span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span></a>';
            $conveniado->numeronocartao = (string) ($conveniado->numeronocartao);
        }

        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Titular', 'width' => 10],
            ['label' => 'Telefone', 'width' => 3],
            ['label' => 'Nascimento', 'width' => 1],
            ['label' => 'Validade', 'width' => 1],
            ['label' => 'Número do Cartão', 'width' => 1],
            ['label' => 'Ações', 'width' => 1, 'no-export' => true],
        ];
        $config = [
            'title' => "Conveniados",
            'data' => $conveniados,
            'order' => [[5, 'desc']],
            'columns' => [null, null, null, ['orderable' => false], ['orderable' => false], null, ['orderable' => false]],
            'lengthMenu' => [10, 50, 100, 500],
        ];
        return view('admin.conveniado.listar2', compact('conveniados', 'cabecalho', 'config'));
    }

    public function listar3() {
        $conveniados = DB::table('conveniados')
                ->leftJoin('contratoconvenios', 'conveniados.id', '=', 'contratoconvenios.conveniado_id')
                ->where('conveniados.empresa_id', Usuario::empresa())
                ->select(
                        'conveniados.id as id',
                        'conveniados.nome as nome',
                        'conveniados.titular_id as titular_id',
                        'conveniados.nascimento as nascimento',
                        'conveniados.sexo as sexo',
                        'conveniados.cidade as cidade',
                        'conveniados.status as status',
                        'contratoconvenios.datadocontrato as datadocontrato',
                        'contratoconvenios.status as contratoconvenios_status',
                        'contratoconvenios.plano_id as plano_id')
                ->get();

        //Corrige informações para exibição
        
        foreach ($conveniados as $conveniado) {
            
            if ($conveniado->titular_id != null && $conveniado->titular_id != "" && $conveniado->titular_id > 0 )
                if(Conveniado::find($conveniado->titular_id)) {
                    $contrato = DB::table('contratoconvenios')->where('conveniado_id', $conveniado->titular_id)->first();
                    if($contrato){ 
                        $conveniado->plano_id = $contrato->plano_id;
                        $conveniado->datadocontrato = $contrato->datadocontrato;
                    }
                    $conveniado->titular_id = Conveniado::find($conveniado->titular_id)->nome;
                }
            else
                $conveniado->titular_id = "";
            
            if($conveniado->plano_id >0) 
                $conveniado->plano_id = Plano::find($conveniado->plano_id)->nome;
            else
                $conveniado->plano_id = '';
            
        }

        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Titular', 'width' => 10],
            ['label' => 'Nascimento', 'width' => 2],
            ['label' => 'Sexo', 'width' => 1],
            ['label' => 'Cidade', 'width' => 3],
            ['label' => 'Plano Contratado', 'width' => 3],
            ['label' => 'Data do Contrato', 'width' => 2],
            ['label' => 'Status', 'width' => 1],
        ];
        $config = [
            'title' => "Conveniados",
            'order' => [[5, 'desc']],
            'columns' => [null, null, null, null, null, null, null, null],
            'lengthMenu' => [10, 50, 100, 500],
        ];
        return view('admin.conveniado.listar3', compact('conveniados', 'cabecalho', 'config'));
    }

    public function listarfiltro(Request $request, Conveniado $conveniado) {
        //dd(Request::all());
        $dadosFiltro = Request::all();
        $conveniados = $conveniado->filtro($dadosFiltro, $this->linhasNaPagina);
        $listaconveniados = DB::table('conveniados')->where('empresa_id', Usuario::empresa())->orderBy('id')->get()->toArray();
        return view('admin.conveniado.listar', compact('conveniados', 'listaconveniados'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $conveniado = Conveniado::find($id);
        if ($conveniado) {
            $conveniado->delete();
        }
        return redirect('/conveniado/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        //DB::table('conveniados')->where('id', $id)->update(['status' => '0']);
        ConveniadoController::bloqueiaTitularDependente($id);
        return redirect('/conveniado/listar')->withInput(); //redireciona por url
    }

    public static function bloqueiaTitularDependente($id_titular) {
        $conveniado = Conveniado::find($id_titular);
        $conveniado->status = 0;
        $conveniado->usuario_id = Usuario::id();
        $conveniado->save();
        $dependentes = DB::table('conveniados')
                ->where('titular_id', $id_titular)
                ->get();
        foreach ($dependentes as $dependente) {
            $conveniado = Conveniado::find($dependente->id);
            $conveniado->status = 0;
            $conveniado->save();
        }
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('conveniados')->where('id', $id)->update(['status' => '1']);
        return redirect('/conveniado/listar')->withInput(); //redireciona por url
    }

    public function confirmarpagamento() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        //Atualiza o status do conveniado
        DB::table('conveniados')
                ->where('empresa_id', Usuario::empresa())
                ->where('id', $id)->update(['status' => '1']);
        //Identifica o id da conta a receber
        $contasareceber_id = DB::table('contratoconvenios')
                ->where('contratoconvenios.empresa_id', Usuario::empresa())
                ->where('contratoconvenios.conveniado_id', $id)
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
        DB::table('conveniados')->where('titular_id', '=', $id)->update(['status' => 1]);

        return redirect('/conveniado/listar'); //redireciona por url
    }

    public function ficha() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $conveniado = DB::table('conveniados')
                ->leftJoin('parentescos', 'conveniados.parentesco_id', 'parentescos.id')
                ->leftJoin('cartaos', 'conveniados.id', '=', 'cartaos.conveniado_id')
                ->where('conveniados.empresa_id', Usuario::empresa())
                ->where('conveniados.id', '=', $id)
                ->select('conveniados.id as id',
                        'conveniados.empresa_id as empresa_id',
                        'conveniados.titular_id as titular_id',
                        'conveniados.nome as nome',
                        'conveniados.cpfcnpj as cpfcnpj',
                        'conveniados.rgie as rgie',
                        'conveniados.nascimento as nascimento',
                        'conveniados.tel1 as tel1',
                        'conveniados.tel2 as tel2',
                        'conveniados.sexo as sexo',
                        'conveniados.logradouro as logradouro',
                        'conveniados.numero as numero',
                        'conveniados.bairro as bairro',
                        'conveniados.complemento as complemento',
                        'conveniados.cidade as cidade',
                        'conveniados.estado as estado',
                        'conveniados.cep as cep',
                        'conveniados.status as status',
                        'conveniados.observacao as observacao',
                        'conveniados.usuario_id as usuario_id',
                        'conveniados.parentesco_id as parentesco_id',
                        'conveniados.created_at as cadastro',
                        'parentescos.nome as parentesco_nome',
                        'cartaos.conveniado_id as conveniado_id',
                        'cartaos.nomenocartao as nomenocartao',
                        'cartaos.numeronocartao as numeronocartao',
                        'cartaos.datadeemissao as datadeemissao',
                        'cartaos.datadevalidade as datadevalidade',
                        'cartaos.status as cartao_status',
                        'cartaos.usuario_id as cartao_usuario_id')
                ->first();
        $dependentes = DB::table('conveniados')
                ->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->where('titular_id', '=', $id)
                ->get();

        $titulars = DB::table('conveniados')
                ->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->where('id', '=', $conveniado->titular_id)
                ->get();
        return view('admin.conveniado.ficha')->with('conveniado', $conveniado)->with('dependentes', $dependentes)->with('titulars', $titulars);
    }

    public function consultarficha() {
        return view('admin.conveniado.consultarficha')->with('erro', null);
    }

    public function consultarcartao() {
        $dados = Request::all();

        $credenciado = DB::table('userscredenciados')
                ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                ->first();
        //dd($credenciado);
        $novaconsulta = new Convenioconsultacartao;
        $novaconsulta->empresa_id = Usuario::empresa();
        $novaconsulta->conveniado_id = null;
        $novaconsulta->credenciado_id = isset($credenciado) ? $credenciado->credenciado_id : null;
        $novaconsulta->numero = $dados['numeronocartao'];
        $novaconsulta->usuario_id = \Illuminate\Support\Facades\Auth::user()->id;
        $novaconsulta->save();

        $conveniado = DB::table('conveniados')
                ->leftJoin('parentescos', 'conveniados.parentesco_id', 'parentescos.id')
                ->leftJoin('cartaos', 'conveniados.id', '=', 'cartaos.conveniado_id')
                ->where('cartaos.numeronocartao', '=', $dados['numeronocartao'])
                ->orWhere('conveniados.cpfcnpj', '=', $dados['numeronocartao'])
                ->where('conveniados.empresa_id', Usuario::empresa())
                ->select('conveniados.id as id',
                        'conveniados.empresa_id as empresa_id',
                        'conveniados.titular_id as titular_id',
                        'conveniados.nome as nome',
                        'conveniados.cpfcnpj as cpfcnpj',
                        'conveniados.rgie as rgie',
                        'conveniados.nascimento as nascimento',
                        'conveniados.tel1 as tel1',
                        'conveniados.tel2 as tel2',
                        'conveniados.sexo as sexo',
                        'conveniados.logradouro as logradouro',
                        'conveniados.numero as numero',
                        'conveniados.bairro as bairro',
                        'conveniados.complemento as complemento',
                        'conveniados.cidade as cidade',
                        'conveniados.estado as estado',
                        'conveniados.cep as cep',
                        'conveniados.status as status',
                        'conveniados.observacao as observacao',
                        'conveniados.usuario_id as usuario_id',
                        'conveniados.parentesco_id as parentesco_id',
                        'conveniados.created_at as cadastro',
                        'parentescos.nome as parentesco_nome',
                        'cartaos.conveniado_id as conveniado_id',
                        'cartaos.nomenocartao as nomenocartao',
                        'cartaos.numeronocartao as numeronocartao',
                        'cartaos.datadeemissao as datadeemissao',
                        'cartaos.datadevalidade as datadevalidade',
                        'cartaos.status as cartao_status',
                        'cartaos.usuario_id as cartao_usuario_id')
                ->first();
        if (!isset($conveniado->cpfcnpj))
            return view('admin.conveniado.consultarficha')->with('erro', "Número do Cartão não existe!");

        $dependentes = DB::table('conveniados')
                ->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->where('titular_id', '=', $conveniado->id)
                ->get();

        $titulars = DB::table('conveniados')
                ->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->where('id', '=', $conveniado->titular_id)
                ->get();

        $novaconsulta = Convenioconsultacartao::find($novaconsulta->id);
        $novaconsulta->conveniado_id = $conveniado->id;
        $novaconsulta->save();
        return view('admin.conveniado.ficha')->with('conveniado', $conveniado)->with('dependentes', $dependentes)->with('titulars', $titulars);
    }

    public function registraratendimento() {
        return view('admin.conveniado.registraratendimento');
    }

    public function cadastrosnovos() {
        $conveniados = DB::table('conveniados')
                ->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', [1])
                ->where('created_at', '>', '2021-12-12')
                ->get();
        $listaconveniados = DB::table('conveniados')->where('empresa_id', Usuario::empresa())->orderBy('id')->get()->toArray();

        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Titular', 'width' => 10],
            ['label' => 'Telefone', 'width' => 3],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 4, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.conveniado.cadastrosnovos', compact('conveniados', 'listaconveniados', 'cabecalho', 'config'));
    }

    public function cadastrospendentes() {
        $conveniados = DB::table('conveniados')
                ->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', [2, 3, 4, 5])
                ->get();
        $listaconveniados = DB::table('conveniados')->where('empresa_id', Usuario::empresa())->orderBy('id')->get()->toArray();

        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Titular', 'width' => 10],
            ['label' => 'Telefone', 'width' => 3],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 4, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.conveniado.cadastrospendentes', compact('conveniados', 'listaconveniados', 'cabecalho', 'config'));
    }

    public function cadastrosvencidos() {
        $conveniados = DB::table('conveniados')
                ->orderBy('nome')
                ->where('empresa_id', Usuario::empresa())
                ->where('status', [0])
                ->get();
        $listaconveniados = DB::table('conveniados')->where('empresa_id', Usuario::empresa())->orderBy('id')->get()->toArray();

        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Nome', 'width' => 10],
            ['label' => 'Titular', 'width' => 10],
            ['label' => 'Telefone', 'width' => 3],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 4, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.conveniado.cadastrosvencidos', compact('conveniados', 'listaconveniados', 'cabecalho', 'config'));
    }

}
