@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('nome') }} ( Nº {{ old('numero') }} ) - Peso: {{ old('peso') }} kg</div>
@endif
@if($errors->all())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $mensagemerro)
        <li>{{$mensagemerro}}</li>
        @endforeach
        <li>Os dados não foram gravados</li>
    </ul>
</div>
@endif
@endif

<div class=" col-sm-12">
    <!--Formulario-->
    <form class="needs-validation" name='FormularioEditarContratoconvenio' id='FormularioEditarContratoconvenio' action="/contratoconvenio/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Contrato de Viagem' name='blocoform01' id='blocoform01'><legend>Informações do Contrato</legend>

            <input type="hidden" name="acao" id="acao" value="Contratoconvenioeditar" />
            <input type="hidden" name="id" id="id" value='{{ $contratoconvenio[0]->id }}' />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="2" />
            <input type="hidden" name="usuario_id" value="2" />

            <div class="form-row">
                <div class="col-md-4 mb-4">
                    <label class="" for='conveniado_id'>Conveniado</label>
                    <x-adminlte-select2 class="form-control" name="conveniado_id" title='Escolha o Conveniado'>
                        @foreach($conveniados as $conveniado)
                        <option value="{{$conveniado->id}}" {{ $conveniado->id == $contratoconvenio[0]->conveniado_id ? ' selected' : '' }} > {{$conveniado->nome}} </option>
                        @endforeach
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-4 mb-4">
                    <label class="" for='plano_id'>Plano</label>
                    <x-adminlte-select2 class="form-control" name="plano_id" title='Escolha o Plano'>
                        @foreach($planos as $plano)
                        <option value="{{$plano->id}}" {{ $plano->id == $contratoconvenio[0]->plano_id ? ' selected' : '' }} >R$ {{ number_format($plano->valor,2,',','.') }} - {{$plano->nome }} </option>
                        @endforeach
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-2 mb-2">
                    <label class="" for='datadocontrato'>Data do contrato</label>
                    <x-adminlte-input class="form-control" name='datadocontrato' type='date'  title='Data do contrato' value="{{ $contratoconvenio[0]->datadocontrato }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">    
                <div class="col-md-2 mb-2">
                    <label class="" for='valor'>Valor</label>
                    <x-adminlte-input class="form-control" name='valor' type='text' title='Valor do contrato' value="{{ number_format($contratoconvenio[0]->valor,2,',','.') }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-4 mb-4">
                    <label class="" for='formadepagamento_id'>Forma de Pagamento</label>
                    <x-adminlte-select2 class="form-control" name="formadepagamento_id" title='Escolha a forma de pagamento'>
                        @foreach($formadepagamentos as $formadepagamento)
                        <option value="{{$formadepagamento->id}}" {{ $formadepagamento->id == $contratoconvenio[0]->formadepagamento_id ? ' selected' : '' }} > {{$formadepagamento->nome }} </option>
                        @endforeach
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-group">

                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>

        </fieldset>

    </form>

</div>

@stop