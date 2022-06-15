<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Cliente; //Adicionado por Cezar
use App\Contasareceber; //Adicionado por Cezar
use App\Http\Requests\ContasareceberRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario;
use App\Formadepagamento;

class ContasareceberController extends Controller {

    public function cadastrar() {
        $clientes = Cliente::where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                        ->where('status', 1)
                        ->orderBy('nome')->get();
        $formadepagamentos = Formadepagamento::where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                        ->where('status', 1)
                        ->orderBy('nome')->get();
        return view('admin.contasareceber.cadastrar')->with('clientes', $clientes)->with('formadepagamentos', $formadepagamentos)->with('usuario_id', auth()->user()->id);
    }

    public function gravar(ContasareceberRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresadousuario(auth()->user()->id);
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        $dados['valor'] = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor
        Contasareceber::create($dados);
        return redirect('/contasareceber/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $clientes = Cliente::where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                        ->where('status', 1)
                        ->orderBy('nome')->get();
        $formadepagamentos = Formadepagamento::where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                        ->where('status', 1)
                        ->orderBy('nome')->get();
        $contasareceber = DB::select('select * from contasarecebers where id = ?', [$id]);
        if(count($contasareceber) == 0) return redirect('/contasareceber/listar'); //redireciona para a lista se não existir a conta
        return view('admin.contasareceber.editar')->with('id', $id)->with('contasareceber', $contasareceber)->with('clientes', $clientes)->with('formadepagamentos', $formadepagamentos)->with('usuario_id', auth()->user()->id);
    }

    public function atualizar(ContasareceberRequest $request) {
        $dados = Request::all();
        $dados['valor'] = str_replace(['.', ','], ['', '.'], $dados['valor']);
        DB::table('contasarecebers')->where('id', $dados['id'])->update([
            'cliente_id' => $dados['cliente_id'],
            'descricao' => $dados['descricao'],
            'valor' => $dados['valor'],
            'vencimento' => $dados['vencimento'],
            'pagamento' => $dados['pagamento'],
            'status' => $dados['status'],
            'observacao' => $dados['observacao'],
            'formadepagamento_id' => $dados['formadepagamento_id']
        ]);
        return redirect('/contasareceber/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $contasareceber = DB::table('contasarecebers')
                        ->where('contasarecebers.empresa_id', Usuario::empresadousuario(auth()->user()->id))
                        ->leftJoin('clientes', 'contasarecebers.cliente_id', '=', 'clientes.id')
                        ->select('contasarecebers.id as contasarecebers_id', 
                                'contasarecebers.cliente_id as contasarecebers_idcliente', 
                                'contasarecebers.descricao as contasarecebers_descricao', 
                                'contasarecebers.valor as contasarecebers_valor', 
                                'contasarecebers.vencimento as contasarecebers_vencimento', 
                                'contasarecebers.pagamento as contasarecebers_pagamento', 
                                'contasarecebers.status as contasarecebers_status', 
                                'clientes.id as clientes_id', 
                                'clientes.nome as clientes_nome')
                        ->orderBy('contasarecebers.pagamento', 'DESC')
                        ->orderBy('contasarecebers.vencimento', 'ASC')
                        ->orderBy('clientes.nome')
                        //->where('contasarecebers.vencimento', '>', date('Y-m-d', (strtotime('-40 days'))))
                        ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Cliente', 'width' => 10],
            ['label' => 'Título', 'width' => 10],
            ['label' => 'Valor', 'width' => 2],
            ['label' => 'Vencimento', 'width' => 2],
            ['label' => 'Pagamento', 'width' => 2],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 1, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];

        return view('admin.contasareceber.listar', compact('contasareceber', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $contasareceber = Contasareceber::find($id);
        if($contasareceber) {           
            $contasareceber->delete();
        }
        return redirect('/contasareceber/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('contasarecebers')->where('id', $id)->update(['status' => '0']);
        return redirect('/contasareceber/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('contasarecebers')->where('id', $id)->update(['status' => '1']);
        return redirect('/contasareceber/listar')->withInput(); //redireciona por url
    }

    public function receber() {
        DB::transaction(function() {
            $id = \Illuminate\Support\Facades\Request::route('id');
            DB::table('contasarecebers')->where('id', $id)->update(['pagamento' => date('Y-m-d')]);
            DB::table('contasarecebers')->where('id', $id)->update(['status' => 2]);
            DB::table('contasarecebers')->where('id', $id)->update(['usuario_id' => auth()->user()->id]);
        });
        return redirect('/contasareceber/listar')->withInput(); //redireciona por url
    }

    public function gerarmensalidade() {
//Se não existir o primeiro registro ele será criado com o valor padrão
        $mensalidadesvazio = DB::table('gerarmensalidades')->count();
        if (!$mensalidadesvazio)
            DB::insert('insert into gerarmensalidades (empresa_id, referenciamensalidade, vencimentomensalidade, status, created_at, updated_at, id_usuario) values (?,?,?,?,?,?,?)', [0, '2019-08-01', '2019-08-10', 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), auth()->user()->id]);
//Busca o ultimo registro
        $mensalidades = DB::table('gerarmensalidades')->orderBy('id', 'desc')->get()->toArray();
//Organiza as datas
        $data = new Carbon($mensalidades[0]->referenciamensalidade);
        $dataultimoprocessamento = $data->format('Y-m-d');
        $data = new Carbon($mensalidades[0]->referenciamensalidade);
        $dataproximoprocessamento = $data->addMonth(1)->format('Y-m-d'); //Altera o valor de data e atribui
        $data = new Carbon($mensalidades[0]->referenciamensalidade);
        $datavencimento = $data->setDate($data->year, $data->month, 10)->addMonth(1)->format('Y-m-d'); //Altera o valor de data e atribui

        return view('admin.contasareceber.gerarmensalidade')
                        ->with('dataultimoprocessamento', $dataultimoprocessamento)
                        ->with('dataproximoprocessamento', $dataproximoprocessamento)
                        ->with('datavencimento', $datavencimento)
                        ->with('usuario_id', auth()->user()->id);
    }

    public function processarmensalidade() {
        ClienteController::importaralunobd();
        $dados = request();
        //dd($dados);
        /*
          echo request()->ultimoperiodo . "<br />";
          echo request()->proximoperiodo . "<br />";
          echo request()->vencimento . "<br />";
         */
        DB::transaction(function() {
            DB::insert('insert into gerarmensalidades (idempresa, referenciamensalidade, vencimentomensalidade, status, created_at, updated_at, id_usuario) values (?,?,?,?,?,?,?)', [0, request()->proximoperiodo, request()->vencimento, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), auth()->user()->id]);

            $matriculas = DB::table('alunos')
                    ->leftJoin('matriculas', 'matriculas.id_aluno', '=', 'alunos.id')
                    ->leftJoin('clientes', 'clientes.nome', '=', 'alunos.nome')
                    ->select('clientes.id as clientes_id', 'clientes.nome as clientes_nome', 'alunos.id as aluno_id', 'alunos.nome as aluno_nome', 'alunos.status as aluno_status', 'matriculas.id as matricula_id', 'matriculas.status as matricula_status', 'matriculas.valor_mensalidade as matricula_valor_mensalidade')
                    ->where('matriculas.status', '1')
                    ->where('alunos.status', '1')
                    ->where('matriculas.created_at', '<', request()->proximoperiodo)
                    ->get();

            foreach ($matriculas as $matricula) {
                /*
                  echo "<br/>".$matricula->aluno_id;
                  echo "<br/>".$matricula->aluno_nome;
                  echo "<br/>".$matricula->matricula_valor_mensalidade;
                 */
                DB::insert('insert into contasarecebers (empresa_id, cliente_id, descricao, valor, vencimento, observacao, status, created_at, updated_at, usuario_id) values (?,?,?,?,?,?,?,?,?,?)', [0, $matricula->clientes_id, 'Referente a Mensalidade do período: ' . implode('/', array_reverse(explode('-', request()->proximoperiodo))), $matricula->matricula_valor_mensalidade, request()->vencimento, "Gerado Automaticamente", 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), auth()->user()->id]);
            }
        });

        return redirect('/contasareceber/gerarmensalidade')->withInput();
    }

    public static function totaldecontasarecebernomes() {
        $valorcontasarecebermes = DB::table('contasarecebers')
                ->where('empresa_id', '=', Usuario::empresa())
                ->where('status', '1')
                ->sum('valor');
        return number_format($valorcontasarecebermes, 2, ',', '.');
    }

    public static function contasarecebernomes() {
          $valorcontasarecebermes = DB::table('contasarecebers')
          ->where('empresa_id', '=', Usuario::empresa())
          ->where('status', '1')
          ->where('vencimento', '>=', date('Y-m-01'))
          ->where('vencimento', '<', date('Y-m-01', strtotime("+1 months")))
          ->sum('valor');
          return number_format($valorcontasarecebermes, 2, ',', '.');
        return number_format($valorcontasarecebermes, 2, ',', '.');
    }

    public static function contasrecebidasnomes() {
        $valorcontasarecebermes = DB::table('contasarecebers')
                ->where('empresa_id', '=', Usuario::empresa())
                ->where('status', '2')
                ->where('pagamento', '>=', date('Y-m-01'))
                ->sum('valor');
        return number_format($valorcontasarecebermes, 2, ',', '.');
    }

    public static function listarcontasareceberdomes() {
        $datainicial = date("Y-m-01");
        $datafinal = date("Y-m-t");
        $contasareceber = DB::table('contasarecebers')
                        ->where('contasarecebers.empresa_id', Usuario::empresadousuario(auth()->user()->id))
                        ->where('contasarecebers.vencimento', '>=', $datainicial)
                        ->where('contasarecebers.vencimento', '<', $datafinal)
                        ->leftJoin('clientes', 'contasarecebers.cliente_id', '=', 'clientes.id')
                        ->select('contasarecebers.id as contasarecebers_id', 'contasarecebers.cliente_id as contasarecebers_cliente_id', 'contasarecebers.descricao as contasarecebers_descricao', 'contasarecebers.valor as contasarecebers_valor', 'contasarecebers.vencimento as contasarecebers_vencimento', 'contasarecebers.pagamento as contasarecebers_pagamento', 'contasarecebers.status as contasarecebers_status', 'clientes.id as clientes_id', 'clientes.nome as clientes_nome')
                        //->orderBy('clientes.nome')
                        //->orderBy('vencimento')
                        //->orderBy('pagamento')
                        ->orderBy('contasarecebers.id', 'DESC')
                        ->limit(10)
                        ->get()->toArray();
        return $contasareceber;
    }

}
