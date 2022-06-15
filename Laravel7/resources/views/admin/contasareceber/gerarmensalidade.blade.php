@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('proximoperiodo'))
@if(!$errors->all())
<div class="alert alert-success"> Gerado as mensalidades para o período: {{ implode('/', array_reverse(explode('-', old('proximoperiodo')))) }} - Vencimento: {{ implode('/', array_reverse(explode('-', old('vencimento')))) }}</div>
@endif
@if($errors->all())
<div class="alert alert-danger">
    <ul>
        @forelse($errors->all() as $mensagemerro)
        <li>{{$mensagemerro}}</li>
        @empty
        @endforelse
        <li>Os dados não foram gravados</li>
    </ul>
</div>
@endif
@endif

<div class=" col-sm-12">
    <!--Formulario-->
    <form class="needs-validation" name='formulariocontasareceber' id='formulariocontasareceber' action="/contasareceber/processarmensalidade" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações da Conta a Receber' name='blocoform01' id='blocoform01'><legend>Informações da Conta a Receber</legend>

                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
                <input type="hidden" name="id_usuario" id="id_usuario" value="{{$id_usuario}}" />

                <div class="form-row">
                    <label class="control-label col-sm-3" for='ultimoperiodo'>Último Período Processado</label>
                    <div class="col-sm-3">
                        <x-adminlte-input class="form-control" name='ultimoperiodo' type='date' size='10' title='' value="{{$dataultimoprocessamento}}" readonly="readonly"/>
                    </div>
                </div>

                <div class="form-row">
                    <label class="control-label col-sm-3" for='proximoperiodo'>Início para o Próximo Período</label>
                    <div class="col-sm-3">
                        <x-adminlte-input class="form-control" name='proximoperiodo' type='date' size='10' title='' value="{{$dataproximoprocessamento}}" readonly="readonly"/>
                    </div>
                </div>

                <div class="form-row">
                    <label class="control-label col-sm-3" for='vencimento'>Data de Vencimento</label>
                    <div  class="col-sm-3">
                        <x-adminlte-input class="form-control" name='vencimento' type='date' size='10' title='Coloque a data de vencimento' value="{{$datavencimento}}"/>
                    </div>
                </div>


                <div class="control-label col-sm-4" ></div>
                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gerar os dados.'>Gerar Mensalidades</button>
                </div>
                <div class="control-label col-sm-4" ></div>
            </fieldset>
        </div>
    </form>
</div>

@stop