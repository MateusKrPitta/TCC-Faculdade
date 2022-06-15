@extends('adminlte::page')

@section('content_header')
<h1>Cartão do Conveniado</h1>
@stop

@section('content')

@if($erro)
<div class="alert alert-danger"> {{ $erro }}</div>
@endif

<div class=" col-sm-12">
    <!--Formulario-->
    <form class="needs-validation" name='FormularioConsultarcartao' id='FormularioCadastrarPlano' action="consultarcartao" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Consultar Cartão' name='blocoform01' id='blocoform01'><legend>Consultar Cartão</legend>

            <input type="hidden" name="acao" id="acao" value="consultarcartao" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />

            <div class="form-row">
                <div class="col-md-4 mb-4">
                    <label class="" for='numeronocartao'>Número do Cartão ou CPF</label>
                    <input class="form-control" name='numeronocartao' type='text' size='16' title='Informe o número no cartão' value='' required>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">

                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para executar a consulta.'>Consultar</button>
                </div>
            </div>

        </fieldset>
    </form>
</div>

@stop