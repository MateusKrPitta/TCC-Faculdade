<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Contasapagar; //Adicionado por Cezar
use App\Cliente; //Adicionado por Cezar
use App\Fornecedor; //Adicionado por Cezar
use App\Http\Requests\ContasapagarRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario;
use App\Formadepagamento;

class ContasapagarController extends Controller {

    public function cadastrar() {
        $fornecedores = Fornecedor::where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                        ->where('status', 1)
                        ->orderBy('nome')->get();
        $formadepagamentos = Formadepagamento::where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                        ->where('status', 1)
                        ->orderBy('nome')->get();
        return view('admin.contasapagar.cadastrar')->with('fornecedores', $fornecedores)->with('formadepagamentos', $formadepagamentos)->with('usuario_id', auth()->user()->id);
    }

    public function gravar(ContasapagarRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresadousuario(auth()->user()->id);
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        $dados['valor'] = str_replace(',', '.', str_replace('.', '', $dados['valor'])); // Corrige formato do valor
        Contasapagar::create($dados);
        return redirect('/contasapagar/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $fornecedores = Fornecedor::where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                        ->where('status', 1)
                        ->orderBy('nome')->get();
        $formadepagamentos = Formadepagamento::where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                        ->where('status', 1)
                        ->orderBy('nome')->get();
        $contasapagar = DB::select('select * from contasapagars where id = ?', [$id]);
        if (count($contasapagar) == 0)
            return redirect('/contasapagar/listar'); //redireciona para a lista se não existir a conta
        return view('admin.contasapagar.editar')->with('id', $id)->with('contasapagar', $contasapagar)->with('formadepagamentos', $formadepagamentos)->with('fornecedores', $fornecedores)->with('usuario_id', auth()->user()->id);
    }

    public function atualizar(ContasapagarRequest $request) {
        $dados = Request::all();
        $dados['valor'] = str_replace(['.', ','], ['', '.'], $dados['valor']);
        DB::table('contasapagars')->where('id', $dados['id'])->update([
            'fornecedor_id' => $dados['fornecedor_id'],
            'descricao' => $dados['descricao'],
            'valor' => $dados['valor'],
            'vencimento' => $dados['vencimento'],
            'pagamento' => $dados['pagamento'],
            'status' => $dados['status'],
            'observacao' => $dados['observacao'],
            'formadepagamento_id' => $dados['formadepagamento_id']
        ]);
        return redirect('/contasapagar/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $contasapagar = DB::table('contasapagars')
                        ->where('contasapagars.empresa_id', Usuario::empresadousuario(auth()->user()->id))
                        ->leftJoin('fornecedores', 'contasapagars.fornecedor_id', '=', 'fornecedores.id')
                        ->select('contasapagars.id as contasapagars_id', 'contasapagars.fornecedor_id as contasapagars_fornecedor_id', 'contasapagars.descricao as contasapagars_descricao', 'contasapagars.valor as contasapagars_valor', 'contasapagars.vencimento as contasapagars_vencimento', 'contasapagars.pagamento as contasapagars_pagamento', 'contasapagars.status as contasapagars_status', 'fornecedores.id as fornecedores_id', 'fornecedores.nome as fornecedores_nome')
                        ->orderBy('contasapagars.pagamento', 'DESC')
                        ->orderBy('contasapagars.vencimento', 'DESC')
                        ->orderBy('fornecedores.nome')
                        ->where('contasapagars.vencimento', '>', date('Y-m-d', (strtotime('-40 days'))))
                        ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Fornecedor', 'width' => 10],
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
        return view('admin.contasapagar.listar', compact('contasapagar', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $contasapagar = Contasapagar::find($id);
        if($contasapagar) {           
            $contasapagar->delete();
        }
        return redirect('/contasapagar/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('contasapagars')->where('id', $id)->update(['status' => '0']);
        return redirect('/contasapagar/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('contasapagars')->where('id', $id)->update(['status' => '1']);
        return redirect('/contasapagar/listar')->withInput(); //redireciona por url
    }

    public function receber() {
        DB::transaction(function() {
            $id = \Illuminate\Support\Facades\Request::route('id');
            DB::table('contasapagars')->where('id', $id)->update(['pagamento' => date('Y-m-d')]);
            DB::table('contasapagars')->where('id', $id)->update(['status' => 2]);
            DB::table('contasapagars')->where('id', $id)->update(['usuario_id' => auth()->user()->id]);
        });
        return redirect('/contasapagar/listar')->withInput(); //redireciona por url
    }

    public static function totaldecontasapagarnomes() {
        $valorcontasapagarmes = DB::table('contasapagars')
                ->where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                ->where('status', '1')
                ->sum('valor');
        return number_format($valorcontasapagarmes, 2, ',', '.');
    }

    public static function contaspagasnomes() {
        $valorcontasapagarmes = DB::table('contasapagars')
                ->where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                ->where('status', '2')
                ->where('pagamento', '>=', date('Y-m-01'))
                ->sum('valor');
        return number_format($valorcontasapagarmes, 2, ',', '.');
    }

    public static function contasapagarnomes() {
        $valorcontasapagarmes = DB::table('contasapagars')
                ->where('empresa_id', Usuario::empresadousuario(auth()->user()->id))
                ->where('status', '1')
                ->where('vencimento', '>=', date('Y-m-01'))
                ->where('vencimento', '<', date('Y-m-01', strtotime("+1 months")))
                ->sum('valor');
        return number_format($valorcontasapagarmes, 2, ',', '.');
    }

    public static function listarcontasapagardomes() {
        $datainicial = date("Y-m-01");
        $datafinal = date("Y-m-t");
        $contasapagar = DB::table('contasapagars')
                        ->where('contasapagars.empresa_id', Usuario::empresadousuario(auth()->user()->id))
                        ->where('contasapagars.vencimento', '>=', $datainicial)
                        ->where('contasapagars.vencimento', '<', $datafinal)
                        ->leftJoin('fornecedores', 'contasapagars.fornecedor_id', '=', 'fornecedores.id')
                        ->select('contasapagars.id as contasapagars_id', 'contasapagars.fornecedor_id as contasapagars_fornecedor_id', 'contasapagars.descricao as contasapagars_descricao', 'contasapagars.valor as contasapagars_valor', 'contasapagars.vencimento as contasapagars_vencimento', 'contasapagars.pagamento as contasapagars_pagamento', 'contasapagars.status as contasapagars_status', 'fornecedores.id as fornecedores_id', 'fornecedores.nome as fornecedores_nome')
                        ->orderBy('fornecedores.nome')
                        ->orderBy('vencimento')
                        ->orderBy('pagamento')
                        ->get()->toArray();
        return $contasapagar;
    }

}
