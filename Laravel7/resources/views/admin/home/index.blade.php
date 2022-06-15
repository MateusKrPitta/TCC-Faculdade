@extends('adminlte::page')

@section('content_header')

@stop

@section('content')
<?php

use App\Http\Controllers\Admin\ContasapagarController;
use App\Http\Controllers\Admin\ContasareceberController;
use App\Http\Controllers\Admin\AdminController;
use App\Permissao;
use App\PermissaoUser;
use App\Usuario;
use App\Http\Controllers\Admin\ProducaoController;
use App\Http\Controllers\Admin\AnimalController;
use App\Http\Controllers\Admin\InseminacaoController;
use App\Http\Controllers\Admin\ConfiguracaoController;
use App\Http\Controllers\Admin\GestacaoController;
use App\Http\Controllers\Admin\ConveniadoController;
use App\Http\Controllers\Admin\CredenciadoController;
use App\Http\Controllers\Admin\ConvenioatendimentoController;
use App\Http\Controllers\Admin\ContratoconvenioController;
use App\Http\Controllers\Admin\ViagemController;
use App\Http\Controllers\Admin\PassagemController;
use App\Http\Controllers\Admin\TelemarketingtransporteController;

//Atribui os acessos do Usuario
$usuario = Usuario::find(\Illuminate\Support\Facades\Auth::user()->id);
foreach ($usuario->permissaos as $permis) {
    Gate::define($permis->nome, function($user) {
        return 1;
    });
}
?>

<section class="content">

    <?php
    /*
     * Teste de Lista de Empresa por usuario
     */

    //echo \App\Empresa::where('id', Usuario::find(1)->empresa_id)->get();

    /*
     * Teste de Lista de usuáris
     *
      $usuarios = Usuario::all();
      foreach ($usuarios as $usuario) {
      echo $usuario->name;
      echo '<br />';
      }
     * 
     */

    //echo auth()->user()->idempresa;

    /*
     * Usuários com acesso a permissao 3
     *
      echo "-------Permissao-------<br/>";
      $permissao = Permissao::find(3);
      echo $permissao->nome;
      echo "<br/>";
      echo "<br/>";
      foreach ($permissao->usuarios as $usuario) {
      echo $usuario->id;
      echo ' - ';
      echo $usuario->name;
      echo "<br/>";
      }
     * 
     */

    /*
     * Permissões do usuário 1 
     *
      echo "--------Usuario------<br/>";
      $usuario = Usuario::find(1);
      echo $usuario->name;
      echo "<br/>";
      echo "<br/>";
      foreach ($usuario->permissaos as $permis) {
      echo $permis->id;
      echo ' - ';
      echo $permis->nome;
      echo "<br/>";
      }
     * 
     */
    /*
     * Permissões do usuário na permissão
     *
     */
    /*
      echo "--------Usuario------<br/>";
      $u = \Illuminate\Support\Facades\Auth::user();
      //dd($u);
      //$usuario = $u;
      echo $u->name;
      echo "<br/>";
      echo "<br/>";
     */

    /*
      //Atribui os acessos do Usuario
      $usuario = Usuario::find(\Illuminate\Support\Facades\Auth::user()->id);
      foreach ($usuario->permissaos as $permis) {
      Gate::define($permis->nome, function($user) {
      return 1;
      });
      }
     * 
     * */

    /*
      echo "<br/>";
      echo "<br/>";
      $permissao = Permissao::where('nome', 'menu-cadastrarempresas')->get('id')[0]->id; //Busca o indice 0 do resultado e mostra o atributo id
      //dd($permissao);
      echo $permissao;

      echo "<br/>";
      echo "<br/>";
      $resposta = DB::table('permissao_usuario')
      ->where('usuario_id', \Illuminate\Support\Facades\Auth::user()->id) //Consulta o id do usuario
      ->where('permissao_id', Permissao::where('nome', 'menu-cadastrarempresas')->get('id')[0]->id) //Consulta na tabela Permissaos o id da opçao de menu
      ->get();
      //dd($resposta);
      echo $resposta[0]->id;

      echo "<br/>";
      echo "<br/>";
      $resposta = DB::table('permissao_usuario')
      ->where('usuario_id', \Illuminate\Support\Facades\Auth::user()->id) //Consulta o id do usuario
      ->where('permissao_id', Permissao::where('nome', 'menu-listarempresas')->get('id')[0]->id) //Consulta na tabela Permissaos o id da opçao de menu
      ->get();
      //dd($resposta);
      echo $resposta[0]->id;

      echo "<br/>";
      echo "<br/>";
      $resposta = DB::table('permissao_usuario')
      ->where('usuario_id', \Illuminate\Support\Facades\Auth::user()->id) //Consulta o id do usuario
      ->where('permissao_id', Permissao::where('nome', 'menu-cadastrarusuario')->get('id')[0]->id) //Consulta na tabela Permissaos o id da opçao de menu
      ->get();
      //dd($resposta);
      echo $resposta[0]->id;
      echo "<br/>";
      echo "<br/>";

      if (
      empty(
      DB::table('permissao_usuario')
      ->where('usuario_id', \Illuminate\Support\Facades\Auth::user()->id) //Consulta o id do usuario
      ->where('permissao_id', Permissao::where('nome', 'menu-cadastrarusuario')->get('id')[0]->id) //Consulta na tabela Permissaos o id da opçao de menu
      ->count()
      ))
      echo '0';
      else
      echo '1';
      echo "<br/>";
      echo "<br/>";

      if (
      is_null(
      DB::table('permissao_usuario')
      ->where('usuario_id', \Illuminate\Support\Facades\Auth::user()->id) //Consulta o id do usuario
      ->where('permissao_id', Permissao::where('nome', 'menu-listarempresas')->get('id')[0]->id) //Consulta na tabela Permissaos o id da opçao de menu
      ->count()
      ))
      echo '0';
      else
      echo '1';

     */
    ?>
    <!-- Small boxes (Stat box) -->
    @can('tela-inicial-atendimento')
    <h1>Atendimento</h1>

    <div class="row">
        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-lightblue">
                <div class="inner">
                    <h3> 6 </h3>
                    <h4>Atendimentos Solicitados</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-pen-square"></i>
                </div>
                <a href="#" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3> 3 </h3>
                    <h4>Atendimentos em Espera</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <a href="#" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3> 2 </h3>
                    <h4>Atendimentos Realizados</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-check-square"></i>
                </div>
                <a href="#" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3> 1 </h3>
                    <h4>Atendimentos Cancelados</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-ban"></i>
                </div>
                <a href="#" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>	


        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-gray">
                <div class="inner">
                    <h3>8</h3>
                    <h4>Orçamentos do mês</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-clipboard"></i>
                </div>
                <a href="#" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-lime">
                <div class="inner">
                    <h3>2</h3>
                    <h4>Orçamentos Atendidos</h4>
                </div>
                <div class="icon">
                    <i class="far fa-file-alt"></i>
                </div>
                <a href="#" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>



    </div>
    @endcan


    @can('tela-inicial-convenio')
    <!-- Small boxes (Stat box) -->
    <h1>Convênio</h1>
    <div class="row">

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h3>{{ConveniadoController::novosConveniados()}}</h3>
                    <h4>Novos Conveniados</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="/conveniado/listar2" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3>{{ConveniadoController::pendentesConveniados()}}</h3>
                    <h4>Cadastros Pendentes</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-user-clock"></i>
                </div>
                <a href="/conveniado/listar" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-dark">
                <div class="inner">
                    <h3>{{ConveniadoController::totalDeConveniados()}}</h3>
                    <h4>Total de Conveniados</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="/conveniado/listar3" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-cyan">
                <div class="inner">
                    <h3>{{ConvenioatendimentoController::atendimentosRealizados()}}</h3>
                    <h4>Atendimentos Realizados</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <a href="/convenioatendimento/listar" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-white">
                <div class="inner">
                    <h3>{{ContratoconvenioController::totalContratos()}}</h3>
                    <h4>Total de Contratos</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <a href="contratoconvenio/listar2" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-indigo">
                <div class="inner">
                    <h3>{{CredenciadoController::totalCredenciados()}}</h3>
                    <h4>Total de Médicos/Clínicas</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <a href="/credenciado/listar" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>


    </div>
    @endcan


    @can('tela-inicial-financeiro')
    <!-- Small boxes (Stat box) -->
    <h1>Financeiro</h1>
    <div class="row">

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>R$ <?php echo ContasareceberController::contasrecebidasnomes(); ?></h3>
                    <h4>Contas recebidas no mês</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-comment-dollar"></i>
                </div>
                <a href="/contasareceber/listar" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3>R$ <?php echo ContasareceberController::contasarecebernomes(); ?></h3>
                    <h4>Contas a receber no mês</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-comments-dollar"></i>
                </div>
                <a href="/contasareceber/listar" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>


        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-lime">
                <div class="inner">
                    <h3>R$ <?php echo ContasareceberController::totaldecontasarecebernomes(); ?></h3>
                    <h4>Total de Contas a Receber</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <a href="/contasareceber/listar" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>


        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>R$ <?php echo ContasapagarController::contaspagasnomes(); ?></h3>
                    <h4>Contas pagas no mês</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-alt"></i>
                </div>
                <a href="/contasapagar/listar" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>R$ <?php echo ContasapagarController::contasapagarnomes(); ?></h3>
                    <h4>Contas a pagar no mês</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill"></i>
                </div>
                <a href="/contasapagar/listar" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>R$ <?php echo ContasapagarController::totaldecontasapagarnomes(); ?></h3>
                    <h4>Total de Contas a Pagar</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-donate"></i>
                </div>
                <a href="/contasapagar/listar" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>



    </div>
    @endcan


    @can('tela-inicial-financeiro-contasapagar')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <!-- ./col -->
        <div class="col-lg-12">
            <!-- small box -->
            <div class="box box-info">
                <div class="box-header with-border"> <h3 class="box-title">Contas a Pagar no Mês</h3> </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Fornecedor</th>
                                    <th class="text-center">Descrição</th>
                                    <th class="text-center">Vencimento</th>
                                    <th class="text-center">Pagamento</th>
                                    <th class="text-right">Valor</th>
                                    <th class="text-center">Situação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(ContasapagarController::listarcontasapagardomes() as $conta)
                                <tr>
                                    <td class="text-center">{{ $conta->fornecedores_nome }}</td>
                                    <td class="text-center">{{ $conta->contasapagars_descricao }}</td>
                                    <td class="text-center">{{ implode('/', array_reverse(explode('-', $conta->contasapagars_vencimento))) }}</td>
                                    <td class="text-center">{{ implode('/', array_reverse(explode('-', $conta->contasapagars_pagamento))) }}</td>
                                    <td class="text-right">R$ {{ number_format($conta->contasapagars_valor,2,',','.') }}</td>
                                    <td class="text-center">
                                        <?php if ($conta->contasapagars_status == 2) { ?>
                                            <span style="color:green" class="fas fa-dollar-sign" aria-hidden="true"></span>
                                        <?php } else {
                                            ?>
                                            <span style="color:red" class="fas fa-dollar-sign" aria-hidden="true"></span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                @empty
                                <div>Não existem lançamentos!</div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix" style="">
                    <!-- Rodapé -->
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>



    @endcan


    @can('tela-inicial-financeiro-contasareceber')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <!-- ./col -->
        <div class="col-lg-12">
            <!-- small box -->
            <div class="box box-info">
                <div class="box-header with-border"> <h3 class="box-title">Contas a Receber no Mês</h3> </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Cliente</th>
                                    <th class="text-center">Descrição</th>
                                    <th class="text-center">Vencimento</th>
                                    <th class="text-center">Pagamento</th>
                                    <th class="text-right">Valor</th>
                                    <th class="text-center">Situação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(ContasareceberController::listarcontasareceberdomes() as $conta)
                                <tr>
                                    <td class="text-center">{{ $conta->clientes_nome }}</td>
                                    <td class="text-center">{{ $conta->contasarecebers_descricao }}</td>
                                    <td class="text-center">{{ implode('/', array_reverse(explode('-', $conta->contasarecebers_vencimento))) }}</td>
                                    <td class="text-center">{{ implode('/', array_reverse(explode('-', $conta->contasarecebers_pagamento))) }}</td>
                                    <td class="text-right">R$ {{ number_format($conta->contasarecebers_valor,2,',','.') }}</td>
                                    <td class="text-center">
                                        <?php if ($conta->contasarecebers_status == 2) { ?>
                                            <span style="color:green" class="fas fa-dollar-sign" aria-hidden="true"></span>
                                        <?php } else {
                                            ?>
                                            <span style="color:red" class="fas fa-dollar-sign" aria-hidden="true"></span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                @empty
                                <div>Não existem lançamentos!</div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix" style="">
                    <!-- Rodapé -->
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>
    @endcan

    @can('tela-inicial-viagem')
    <!-- Small boxes (Stat box) -->
    <h1>Viagem</h1>
    <div class="row">

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{ ViagemController::totaldeviagens() }}</h3>
                    <h4>Viagens Ativas</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-map-signs"></i>
                </div>
                <a href="/viagem/listar" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3>{{ PassagemController::totaldepassagens() }}</h3>
                    <h4>Poltronas Reservadas</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-bus"></i>
                </div>
                <a href="/passagem/listar" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ TelemarketingtransporteController::totaldeligacoes() }}</h3>
                    <h4>Ligações realizadas</h4>
                </div>
                <div class="icon">
                    <i class="fas fa-phone"></i>
                </div>
                <a href="/telemarketingtransporte/listar" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>


    </div>
    <!-- /.row -->

    @endcan



    @can('tela-inicial-rebanho')
    <!-- Small boxes (Stat box) -->
    <h1>Rebanho</h1>
    <div class="row">

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo ProducaoController::producaododia(); ?> Litros</h3>
                    <p>Produção de leite hoje</p>
                </div>
                <div class="icon">
                    <i class="fas fa-prescription-bottle"></i>
                </div>
                <a href="#" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo GestacaoController::previsao_de_nascimento(); ?> Bezerros</h3>
                    <p>Previsão (Próximos 30 dias)</p>
                </div>
                <div class="icon">
                    <i class="fab fa-sticker-mule"></i>
                </div>
                <a href="#" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo AnimalController::novosmensal(); ?></h3>
                    <p>Novos (Últimos 30 dias)</p>
                </div>
                <div class="icon">
                    <i class="fab fa-sticker-mule"></i>
                </div>
                <a href="#" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?php echo AnimalController::baixamensal(); ?></h3>

                    <p>Baixas (Últimos 30 dias)</p>
                </div>
                <div class="icon">
                    <i class="fab fa-sticker-mule"></i>
                </div>
                <a href="#" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-navy">
                <div class="inner">
                    <h3><?php echo InseminacaoController::prontoinseminar(); ?></h3>
                    <p>Prontos para inseminação</p>
                </div>
                <div class="icon">
                    <i class="fas fa-thermometer"></i>
                </div>
                <a href="#" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-fuchsia">
                <div class="inner">
                    <h3><?php echo InseminacaoController::semconfirmacao(); ?></h3>

                    <p>Inseminadas sem confirmação</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <a href="#" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3><?php echo GestacaoController::vacas_gestacionando(); ?></h3>

                    <p>Animais Gestacionando</p>
                </div>
                <div class="icon">
                    <i class="fas fa-notes-medical"></i>
                </div>
                <a href="#" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3><?php echo GestacaoController::vacas_para_secar(); ?></h3>
                    <p>Vacas para secar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-pills"></i>
                </div>
                <a href="#" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>


    </div>
    <!-- /.row -->

    @endcan

</section>

@stop