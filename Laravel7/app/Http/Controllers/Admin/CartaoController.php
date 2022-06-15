<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request; //Removido por Cezar
use Illuminate\Support\Facades\Request; //Adicionado por Cezar
use Illuminate\Support\Facades\DB; //Adicionado por Cezar
use Illuminate\Support\Facades\Validator; //Adicionado por Cezar
use App\Http\Controllers\Controller;
use App\Cartao; //Adicionado por Cezar
use App\Http\Requests\CartaoRequest; //Adicionado por Cezar
use Carbon\Carbon; //API para trabalhar com tempo
use App\Usuario; //Adicionado por Cezar
use App\Conveniado; //Adicionado por Cezar
//use Barryvdh\DomPDF\PDF; //Adicionado por Cezar
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\CartaoViewExport; //Adicionado por Cezar
use Maatwebsite\Excel\Facades\Excel;

class CartaoController extends Controller {

    public function visualizar() {
        $id = Request::route('id');
        if (DB::table('cartaos')->where('empresa_id', Usuario::empresa())->where('conveniado_id', $id)->count() < 1) {
            $this->criarcartao($id);
        }
        $cartao = DB::table('cartaos')
                ->leftJoin('conveniados', 'cartaos.conveniado_id', '=', 'conveniados.id')
                ->where('cartaos.empresa_id', Usuario::empresa())
                ->where('cartaos.conveniado_id', $id)
                ->select('conveniados.id as id',
                        'conveniados.empresa_id as empresa_id',
                        'conveniados.titular_id as titular_id',
                        'conveniados.nome as nome',
                        'conveniados.nascimento as nascimento',
                        'conveniados.usuario_id as usuario_id',
                        'cartaos.conveniado_id as conveniado_id',
                        'cartaos.nomenocartao as nomenocartao',
                        'cartaos.numeronocartao as numeronocartao',
                        'cartaos.datadeemissao as datadeemissao',
                        'cartaos.datadevalidade as datadevalidade')
                ->first();
        if ($cartao->titular_id < 1) {
            $titular = new \App\Credenciado;
            $titular->nome = "";
        } else {
            $titular = DB::table('conveniados')
                    ->where('conveniados.empresa_id', Usuario::empresa())
                    ->where('conveniados.id', $cartao->titular_id)
                    ->first();
        }
        return view('admin.cartao.visualizar')->with('cartao', $cartao)->with('titular', $titular);
    }

    public function pdf() {
        $id = Request::route('id');
        if (DB::table('cartaos')->where('empresa_id', Usuario::empresa())->where('conveniado_id', $id)->count() < 1) {
            $this->criarcartao($id);
        }
        $cartao = DB::table('cartaos')
                ->leftJoin('conveniados', 'cartaos.conveniado_id', '=', 'conveniados.id')
                ->where('cartaos.empresa_id', Usuario::empresa())
                ->where('cartaos.conveniado_id', $id)
                ->select('conveniados.id as id',
                        'conveniados.empresa_id as empresa_id',
                        'conveniados.titular_id as titular_id',
                        'conveniados.nome as nome',
                        'conveniados.nascimento as nascimento',
                        'conveniados.usuario_id as usuario_id',
                        'cartaos.conveniado_id as conveniado_id',
                        'cartaos.nomenocartao as nomenocartao',
                        'cartaos.numeronocartao as numeronocartao',
                        'cartaos.datadeemissao as datadeemissao',
                        'cartaos.datadevalidade as datadevalidade')
                ->first();
        if ($cartao->titular_id < 1) {
            $titular = new \App\Credenciado;
            $titular->nome = "";
        } else {
            $titular = DB::table('conveniados')
                    ->where('conveniados.empresa_id', Usuario::empresa())
                    ->where('conveniados.id', $cartao->titular_id)
                    ->first();
        }

        $pdf = PDF::setOptions(['dpi' => 150,
                    'chroot' => public_path(),
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'isPhpEnabled' => true,
                    'defaultFont' => 'sans-serif',
                    'enable-javascript' => true,
                    'images' => true,
                ])
                ->setPaper('a4', 'portrait')
                ->loadView('admin.cartao.pdf', ['cartao' => $cartao, 'titular' => $titular], [], null);
        return $pdf->stream('Cartão.pdf');
    }

    public function gerarnumerodocartao($conveniado_id) {
        $bandeiradocartao = 880920; //6 digitos
        $numeroderegistro = str_pad(Cartao::all()->count() + 1, 9, "0", STR_PAD_LEFT); //9 digitos
        $numerododigitoverificador = (Cartao::all()->count() + 1) * 19; // 1 digito
        while ($numerododigitoverificador >= 10)
            $numerododigitoverificador = intdiv($numerododigitoverificador, 10);
        $numerodocartao = $bandeiradocartao . $numeroderegistro . $numerododigitoverificador;
        return $numerodocartao;
    }

    public function criarcartao($conveniado_id) {
        $conveniado = Conveniado::find($conveniado_id);
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        $dados['conveniado_id'] = $conveniado->id;
        $dados['nomenocartao'] = $conveniado->nome;
        $dados['numeronocartao'] = $this->gerarnumerodocartao($conveniado_id);
        $dados['datadeemissao'] = date('Y-m-d');
        $dados['datadevalidade'] = date('Y-m-d', strtotime("+1 year"));
        $dados['status'] = 1;
        return Cartao::create($dados);
    }

    public function cadastrar() {
        $conveniados = Conveniado::all()->sortBy('id')->where('empresa_id', Usuario::empresa());
        return view('admin.cartao.cadastrar')->with('conveniados', $conveniados);
    }

    public function gravar(CartaoRequest $request) {
        $dados = Request::all();
        $dados['empresa_id'] = Usuario::empresa();
        $dados['usuario_id'] = \Illuminate\Support\Facades\Auth::user()->id;
        Cartao::create($dados);
        return redirect('/cartao/cadastrar')->withInput();
    }

    public function editar() {
        $id = Request::route('id');
        $cartao = DB::select('select * from cartaos where id = ?', [$id]);
        return view('admin.cartao.editar')->with('cartao', $cartao);
    }

    public function atualizar() {
        $dados = Request::all();
        $cartao = Cartao::find($dados['id']);
        $cartao->nome = $dados['nome'];
        $cartao->evento = $dados['evento'];
        $cartao->data = $dados['data'];
        $cartao->hora = $dados['hora'];
        $cartao->status = $dados['status'];
        $cartao->observacao = $dados['observacao'];
        $cartao->save();
        return redirect('/cartao/listar')->withInput(); //redireciona por url
    }

    public function listar() {
        $cartaos = DB::table('cartaos')
                ->leftJoin('users', 'cartaos.usuario_id', '=', 'users.id')
                ->where('cartaos.empresa_id', Usuario::empresa())
                ->get();
        
//Corrige erro da numeração do cartao
        foreach ($cartaos as $cartao) {
            if ($cartao->numeronocartao > 9999999999999999) {
                $numerododigitoverificador = str_split($cartao->numeronocartao, 16);
                DB::table('cartaos')
                        ->where('cartaos.numeronocartao', $cartao->numeronocartao)
                        ->update(['cartaos.numeronocartao' => $numerododigitoverificador[0]]);
            }
        }
//Fim da Correção do erro na numeração
//
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'ID', 'width' => 1],
            ['label' => 'Nome no Cartão', 'width' => 10],
            ['label' => 'Número no Cartão', 'width' => 5],
            ['label' => 'Emissão', 'width' => 3],
            ['label' => 'Vencimento', 'width' => 3],
            ['label' => 'Usuário', 'width' => 8],
            ['label' => 'Status', 'width' => 1, 'no-export' => true],
            ['label' => 'Ações', 'width' => 2, 'no-export' => true],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, null, ['orderable' => false], ['orderable' => false]],
        ];
        return view('admin.cartao.listar', compact('cartaos', 'cabecalho', 'config'));
    }

    public function controle() {
        $cartaos = DB::table('cartaos')
                ->where('cartaos.empresa_id', Usuario::empresa())
                ->orderBy('id')
                ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Número no Cartão', 'width' => 2],
            ['label' => 'Nome no Cartão', 'width' => 10],
            ['label' => 'Vencimento', 'width' => 2],
            ['label' => 'Emissão', 'width' => 2],
            ['label' => 'Produção', 'width' => 2],
            ['label' => 'Entrega', 'width' => 2],
            ['label' => 'Status', 'width' => 1],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, null, null],
        ];
        return view('admin.cartao.controle', compact('cartaos', 'cabecalho', 'config'));
    }

    public function apagar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        $cartao = Cartao::find($id);
        if ($cartao) {
            $cartao->delete();
        }
        return redirect('/cartao/listar')->withInput(); //redireciona por url
    }

    public function bloquear() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('cartaos')->where('id', $id)->update(['status' => '0']);
        return redirect('/cartao/listar')->withInput(); //redireciona por url
    }

    public function ativar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('cartaos')->where('id', $id)->update(['status' => '1']);
        return redirect('/cartao/listar')->withInput(); //redireciona por url
    }

    public function produzir() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('cartaos')->where('id', $id)->update(['dataproducao' => date('Y-m-d')]);
        return redirect('/cartao/controle')->withInput(); //redireciona por url
    }

    public function desproduzir() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('cartaos')->where('id', $id)->update(['dataproducao' => null]);
        return redirect('/cartao/controle')->withInput(); //redireciona por url
    }

    public function entregar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('cartaos')->where('id', $id)->update(['dataentrega' => date('Y-m-d')]);
        return redirect('/cartao/controle')->withInput(); //redireciona por url
    }

    public function desentregar() {
        $id = \Illuminate\Support\Facades\Request::route('id');
        DB::table('cartaos')->where('id', $id)->update(['dataentrega' => null]);
        return redirect('/cartao/controle')->withInput(); //redireciona por url
    }

    public function cartoesentregues() {
        $cartaos = DB::table('cartaos')
                ->where('cartaos.empresa_id', Usuario::empresa())
                ->where('cartaos.dataentrega', '>', '2000-01-01')
                ->orderBy('id')
                ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Número no Cartão', 'width' => 2],
            ['label' => 'Nome no Cartão', 'width' => 10],
            ['label' => 'Vencimento', 'width' => 2],
            ['label' => 'Emissão', 'width' => 2],
            ['label' => 'Produção', 'width' => 2],
            ['label' => 'Entrega', 'width' => 2],
            ['label' => 'Status', 'width' => 1],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, null, null],
        ];
        return view('admin.cartao.cartoesentregues', compact('cartaos', 'cabecalho', 'config'));
    }

    public function cartoesparaentregar() {
        $cartaos = DB::table('cartaos')
                ->where('cartaos.empresa_id', Usuario::empresa())
                ->where('cartaos.dataproducao', '>', '2000-01-01')
                ->where('cartaos.dataentrega', '=', null)
                ->orderBy('id')
                ->get();
        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Número no Cartão', 'width' => 2],
            ['label' => 'Nome no Cartão', 'width' => 10],
            ['label' => 'Vencimento', 'width' => 2],
            ['label' => 'Emissão', 'width' => 2],
            ['label' => 'Produção', 'width' => 2],
            ['label' => 'Entrega', 'width' => 2],
            ['label' => 'Status', 'width' => 1],
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, null, null],
        ];
        return view('admin.cartao.cartoesparaentregar', compact('cartaos', 'cabecalho', 'config'));
    }

    public function cartoesaguardandopedido() {
        $cartaos = DB::table('cartaos')
                ->leftJoin('conveniados', 'cartaos.conveniado_id', '=', 'conveniados.id')
                ->leftJoin('contratoconvenios', 'cartaos.conveniado_id', '=', 'contratoconvenios.conveniado_id')
                ->where('cartaos.empresa_id', Usuario::empresa())
                ->where('cartaos.datadeemissao', '>', '2000-01-01')
                ->where('cartaos.dataproducao', '=', null)
                ->where('cartaos.dataentrega', '=', null)
                ->select(
                        'cartaos.id as id',
                        'cartaos.empresa_id as empresa_id',
                        'cartaos.conveniado_id as conveniado_id',
                        'cartaos.nomenocartao as nomenocartao',
                        'cartaos.numeronocartao as numeronocartao',
                        'cartaos.datadevalidade as datadevalidade',
                        'cartaos.status as status',
                        'cartaos.dataproducao as dataproducao',
                        'cartaos.dataentrega as dataentrega',
                        'conveniados.id as conveniado_id',
                        'conveniados.titular_id as titular_id',
                        'conveniados.nascimento as nascimento',
                        'contratoconvenios.id as contratoconveniado_id',
                        'contratoconvenios.plano_id as plano_id'
                        )
                ->orderBy('conveniados.id')
                ->get();
        //Corrige dados
        foreach ($cartaos as $cartao) {
            if (!$cartao->titular_id ) {
                $cartao->titular_id = $cartao->conveniado_id;
            }
            if (!$cartao->plano_id ) {
                $cartao->plano_id = DB::table('contratoconvenios')->where('conveniado_id', $cartao->titular_id)->first()->plano_id;
            }
            if ($cartao->titular_id ) {
                $cartao->titular_id = Conveniado::find($cartao->titular_id)->nome;
            }
            if ($cartao->plano_id ) {
                $cartao->plano_id = \App\Plano::find($cartao->plano_id)->nome;
            }
        }

        //Configuração da Tabela
        $cabecalho = [
            ['label' => 'Nome no Cartão', 'width' => 10],
            ['label' => 'Número no Cartão', 'width' => 2],
            ['label' => 'Nascimento', 'width' => 2],
            ['label' => 'Validade', 'width' => 2],
            ['label' => 'Titular', 'width' => 2],
            ['label' => 'Plano', 'width' => 1],
            ['label' => 'Status', 'width' => 1],
            ['label' => 'Produção', 'width' => 2],
            ['label' => 'Entrega', 'width' => 2],
            
        ];
        $config = [
            'order' => [[0, 'asc']],
            'columns' => [null, null, null,null, null, null, null, null, null],
        ];
        return view('admin.cartao.cartoesaguardandopedido', compact('cartaos', 'cabecalho', 'config'));
    }

}
