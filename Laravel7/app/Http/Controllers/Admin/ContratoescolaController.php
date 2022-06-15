<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Contratoescola; //Adicionado por Cezar
use App\Http\Requests\ContratoescolaRequest; //Adicionado por Cezar
use Carbon\Carbon; //Classe para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use App\Cliente;
use App\Aluno;
use App\Formadepagamento;

class ContratoescolaController extends Controller {

    public function cadastrar() {
        $clientes = Cliente::where('empresa_id', Usuario::empresa())
                ->orderBy('nome')
                ->get();
        $formadepagamentos = Formadepagamento::where('empresa_id', Usuario::empresa())
                ->orderBy('nome')
                ->get();
        $alunos = Aluno::where('empresa_id', Usuario::empresa())
                ->orderBy('nome')
                ->get();
        $config = DB::table('contratoescolaconfiguracaos')
                ->where('empresa_id', Usuario::empresa())
                ->count();
        if($config < 1) return redirect('/contratoescola/config');
        $config = DB::table('contratoescolaconfiguracaos')
                ->where('empresa_id', Usuario::empresa())
                ->first();
        return view('admin.contratoescola.cadastrar')->with('formadepagamentos', $formadepagamentos)->with('clientes', $clientes)->with('config', $config)->with('alunos', $alunos);
    }

    public function gravar(ContratoescolaRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        $dados['valor'] = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor
        $dados['status'] = 1;
        Contratoescola::create($dados);
        return redirect('/contratoescola/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $clientes = Cliente::where('empresa_id', Usuario::empresa())
                ->orderBy('nome')
                ->get();
        $formadepagamentos = Formadepagamento::where('empresa_id', Usuario::empresa())
                ->orderBy('nome')
                ->get();
        $alunos = Aluno::where('empresa_id', Usuario::empresa())
                ->orderBy('nome')
                ->get();
        $config = DB::table('contratoescolaconfiguracaos')
                ->where('empresa_id', Usuario::empresa())
                ->count();
        if($config < 1) return redirect('/contratoescola/config');
        $config = DB::table('contratoescolaconfiguracaos')
                ->where('empresa_id', Usuario::empresa())
                ->first();
        $contratoescola = Contratoescola::find($id);
        $contratoescola->valor = str_replace('.', ',', $contratoescola->valor); // Corrige formato do valor
        return view('admin.contratoescola.editar')->with('formadepagamentos', $formadepagamentos)->with('clientes', $clientes)->with('config', $config)->with('alunos', $alunos)->with('contratoescola', $contratoescola);
    }

    public function atualizar(ContratoescolaRequest $request) {
        $dados = Request::all();
        $contratoescola = Contratoescola::find($dados['id']);
        $contratoescola->cliente_id = $dados['cliente_id'];
        $contratoescola->aluno_id = $dados['aluno_id'];
        $contratoescola->datadocontrato = $dados['datadocontrato'];
        $contratoescola->valor = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor
        $contratoescola->formadepagamento_id = $dados['formadepagamento_id'];
        $contratoescola->modalidade = $dados['modalidade'];
        $contratoescola->anoletivo = $dados['anoletivo'];
        $contratoescola->autorizaredessociais = $dados['autorizaredessociais'];
        $contratoescola->titulocontrato1 = $dados['titulocontrato1'];
        $contratoescola->titulocontrato2 = $dados['titulocontrato2'];
        $contratoescola->endereco1 = $dados['endereco1'];
        $contratoescola->endereco2 = $dados['endereco2'];
        $contratoescola->razaosocial = $dados['razaosocial'];
        $contratoescola->enderecorazaosocial = $dados['enderecorazaosocial'];
        $contratoescola->cnpj = $dados['cnpj'];
        $contratoescola->inscricaomunicipal = $dados['inscricaomunicipal'];
        $contratoescola->valorintegral = $dados['valorintegral'];
        $contratoescola->valorparcial = $dados['valorparcial'];
        $contratoescola->valorhoraextra = $dados['valorhoraextra'];
        $contratoescola->valorrefeicaoextra = $dados['valorrefeicaoextra'];
        $contratoescola->valor19horas = $dados['valor19horas'];
        $contratoescola->horariointegral = $dados['horariointegral'];
        $contratoescola->horarioparcial = $dados['horarioparcial'];
        $contratoescola->anexotexto = $dados['anexotexto'];
        $contratoescola->cidadeforo = $dados['cidadeforo'];
        $contratoescola->cidadecontrato = $dados['cidadecontrato'];
        $contratoescola->observacao = $dados['observacao'];
        $contratoescola->usuario_id = Usuario::id();
        //$contratoescola->status = $dados['status'];
        $contratoescola->save();
        return redirect('/contratoescola/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $contratoescola = DB::table('contratoescolas')
                ->orderBy('contratoescolas.datadocontrato')
                ->where('contratoescolas.empresa_id', '=', Usuario::empresa())
                ->leftJoin('alunos', 'contratoescolas.aluno_id', '=', 'alunos.id')
                ->leftJoin('clientes', 'contratoescolas.cliente_id', '=', 'clientes.id')
                ->select('contratoescolas.id as id',
                        'contratoescolas.empresa_id as empresa_id',
                        'contratoescolas.aluno_id as aluno_id',
                        'contratoescolas.cliente_id as cliente_id',
                        'contratoescolas.datadocontrato as datadocontrato',
                        'contratoescolas.valor as valor',
                        'contratoescolas.status as status',
                        'clientes.nome as cliente_nome',
                        'clientes.cpfcnpj as cliente_cpf',
                        'clientes.rgie as cliente_rg',
                        'clientes.nascimento as cliente_nascimento',
                        'clientes.tel1 as cliente_tel1',
                        'clientes.sexo as cliente_sexo',
                        'clientes.cidade as cliente_cidade',
                        'clientes.estado as cliente_estado',
                        'clientes.status as cliente_status',
                        'alunos.nome as aluno_nome',
                        'alunos.status as aluno_status')
                ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Cliente', 'width' => 10],
            ['label' => 'Aluno', 'width' => 3],
            ['label' => 'Data', 'width' => 3],
            ['label' => 'Valor', 'width' => 1],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 2, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.contratoescola.listar', compact('contratoescola', 'cabecalho', 'config'));
    }

    public function config() {
        $configuracao = DB::table('contratoescolaconfiguracaos')
                ->where('empresa_id', Usuario::empresa())
                ->count();
        if ($configuracao < 1) {
            $configuracao = new \PhpParser\PrettyPrinter\Standard;
            $configuracao->titulocontrato1 = "CONTRATO DE SERVIÇO EDUCAÇÃO INFANTIL";
            $configuracao->titulocontrato2 = "ESPAÇO PEGAGÓCICO DA PRO ELI – UM LUGAR PARA CRESCER";
            $configuracao->endereco1 = "Avenida André Moya Perez, 70, CEP 79.750-000 - Portal do Parque-Nova Andradina-MS";
            $configuracao->endereco2 = "Tel.: 67-9870-8716 – CNPJ nº 20.213.935/0001-63 Insc. Municipal nº 13.058";
            $configuracao->razaosocial = "ELISANGELA GOMES DA SILVA RIBEIRO - MEI";
            $configuracao->enderecorazaosocial = "Avenida André Moya Perez, nº 70, Bairro Portal do Parque, MS, CEP: 79.750-000";
            $configuracao->cnpj = "20.213.935/0001-63";
            $configuracao->inscricaomunicipal = "nº 13.058";
            $configuracao->valorintegral = "R$ 25.400,00 Período Integral ";
            $configuracao->valorparcial = "R$ 22.700,00 Período Parcial ";
            $configuracao->valorhoraextra = "R$ 20,00";
            $configuracao->valorrefeicaoextra = "R$ 18,00";
            $configuracao->valor19horas = "uma taxa de R$ 20,00 a cada quarto de hora. ";
            $configuracao->horariointegral = "7 às 18h ";
            $configuracao->horarioparcial = "13 às 18h ";
            $configuracao->anexotexto = "Os(As) CONTRATANTES declaram, sob as penas da lei, que neste ato recebem uma cópia do contrato e das Normas e Procedimentos/2021, que entenderam e concordam com todas as cláusulas e condições. ";
            $configuracao->cidadeforo = "Nova Andradina no Estado de Mato Grosso do Sul";
            $configuracao->cidadecontrato = "Nova Andradina - MS";
        } else {
            $configuracao = DB::table('contratoescolaconfiguracaos')
                    ->where('empresa_id', Usuario::empresa())
                    ->first();
        }
        return view('admin.contratoescola.config')->with('configuracao', $configuracao);
    }

    public function atualizarconfig() {
        $dados = Request::all();

        DB::table('contratoescolaconfiguracaos')
                ->updateOrInsert(
                        ['empresa_id' => Usuario::empresa()],
                        [
                            'titulocontrato1' => $dados['titulocontrato1'],
                            'titulocontrato2' => $dados['titulocontrato2'],
                            'endereco1' => $dados['endereco1'],
                            'endereco2' => $dados['endereco2'],
                            'razaosocial' => $dados['razaosocial'],
                            'enderecorazaosocial' => $dados['enderecorazaosocial'],
                            'cnpj' => $dados['cnpj'],
                            'inscricaomunicipal' => $dados['inscricaomunicipal'],
                            'valorintegral' => $dados['valorintegral'],
                            'valorparcial' => $dados['valorparcial'],
                            'valorhoraextra' => $dados['valorhoraextra'],
                            'valorrefeicaoextra' => $dados['valorrefeicaoextra'],
                            'valor19horas' => $dados['valor19horas'],
                            'horariointegral' => $dados['horariointegral'],
                            'horarioparcial' => $dados['horarioparcial'],
                            'anexotexto' => $dados['anexotexto'],
                            'cidadeforo' => $dados['cidadeforo'],
                            'cidadecontrato' => $dados['cidadecontrato'],
                            'usuario_id' => \Illuminate\Support\Facades\Auth::user()->id
                        ]
        );

        $configuracao = DB::table('contratoescolaconfiguracaos')
                ->where('empresa_id', Usuario::empresa())
                ->first();
        return view('admin.contratoescola.config')->with('configuracao', $configuracao);
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $contratoescola = Contratoescola::find($id);
        if ($contratoescola) {
            $contratoescola->delete();
        }
        return redirect('/contratoescola/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('contratoescolas')->where('id', $id)->update(['status' => '0']);
        return redirect('/contratoescola/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('contratoescolas')->where('id', $id)->update(['status' => '1']);
        return redirect('/contratoescola/listar')->withInput(); //redireciona por url
    }

    public function imprimircontrato() {
        $id = Request::route('id');
        $contratoescola = DB::table('contratoescolas')
                ->orderBy('contratoescolas.datadocontrato')
                ->where('contratoescolas.id', '=', $id)
                ->leftJoin('alunos', 'contratoescolas.aluno_id', '=', 'alunos.id')
                ->leftJoin('clientes', 'contratoescolas.cliente_id', '=', 'clientes.id')
                ->select('contratoescolas.*',
                        'clientes.nome as cliente_nome',
                        'clientes.status as cliente_status',
                        'alunos.*')
                ->first();
        if($contratoescola->modalidade == 'M') $contratoescola->modalidade = 'Matutino';
        if($contratoescola->modalidade == 'V') $contratoescola->modalidade = 'Vespertino';
        if($contratoescola->modalidade == 'E') $contratoescola->modalidade = 'Estendido';
        if($contratoescola->modalidade == 'I') $contratoescola->modalidade = 'Integral';
        if($contratoescola->modalidade == 'B') $contratoescola->modalidade = 'Berçário';
        $contratoescola->datadocontrato = date('d / m / Y', strtotime($contratoescola->datadocontrato));
        $configuracao = DB::table('contratoescolaconfiguracaos')
                    ->where('empresa_id', Usuario::empresa())
                    ->first();
        return view('admin.contratoescola.imprimircontrato')
                ->with('contratoescola', $contratoescola)
                ->with('configuracao', $configuracao);
    }

}
