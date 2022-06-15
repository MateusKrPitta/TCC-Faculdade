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
    <form class="needs-validation" name='FormularioEditarContratoviagem' id='FormularioEditarContratoviagem' action="/contratoviagem/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Contrato de Viagem' name='blocoform01' id='blocoform01'><legend>Informações do Contrato de Viagem</legend>

            <input type="hidden" name="acao" id="acao" value="Contratoviagemeditar" />
            <input type="hidden" name="id" id="id" value='{{ $contratoviagem[0]->id }}' />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="2" />
            <input type="hidden" name="usuario_id" value="2" />

            <div class="form-row">
                <div class="col-md-4 mb-4">
                    <label class="" for='cliente_id'>Cliente</label>
                    <x-adminlte-select2 class="form-control" name="cliente_id" title='Escolha a Viagem'>
                        @forelse($clientes as $cliente)
                        <option value="{{$cliente->id}}" {{ $cliente->id == $contratoviagem[0]->cliente_id ? ' selected' : '' }} > {{$cliente->nome}} </option>
                        @empty
                        @endforelse
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <label class="" for='veiculo_id'>Veículo</label>
                    <x-adminlte-select2 class="form-control" name="veiculo_id" title='Escolha a Viagem'>
                        @forelse($veiculos as $veiculo)
                        <option value="{{$veiculo->id}}" {{ $veiculo->id == $contratoviagem[0]->veiculo_id ? ' selected' : '' }} > {{$veiculo->nome}} </option>
                        @empty
                        @endforelse
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-2">
                    <label class="" for='datadocontrato'>Data do contrato</label>
                    <x-adminlte-input class="form-control" name='datadocontrato' type='date'  title='Data do contrato' value="{{ $contratoviagem[0]->datadocontrato }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-4 mb-4">
                    <label class="" for='localdedestino'>Local de Destino</label>
                    <x-adminlte-input class="form-control" name='localdedestino' type='text'  title='Local de destino da viagem' value="{{ $contratoviagem[0]->localdedestino }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-6 mb-6">
                    <label class="" for='itinerario'>Itinerário</label>
                    <x-adminlte-input class="form-control" name='itinerario' type='text' size='90' title='Coloque o itinerário da viagem' value="{{ $contratoviagem[0]->itinerario }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='valor'>Valor</label>
                    <x-adminlte-input class="form-control" name='valor' type='text' title='Valor do contrato' value="{{ number_format($contratoviagem[0]->valor,2,',','.') }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-4 mb-4">
                    <label class="" for='localembarqueinicio'>Local de Embarque para início da viagem</label>
                    <x-adminlte-input class="form-control" name='localembarqueinicio' type='text'  title='Local de Embarque para início da viagem' value="{{ $contratoviagem[0]->localembarqueinicio }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="" for='datainicio'>Data do início da Viagem</label>
                    <x-adminlte-input class="form-control" name='datainicio' type='date'  title='Data do início da Viagem' value="{{ $contratoviagem[0]->datainicio }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="" for='horainicio'>Horário do início da viagem</label>
                    <x-adminlte-input class="form-control" name='horainicio' type='time'  title='Horário do início da viagem' value="{{ $contratoviagem[0]->horainicio }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-4 mb-4">
                    <label class="" for='localembarqueretorno'>Local de Embarque para retorno da viagem</label>
                    <x-adminlte-input class="form-control" name='localembarqueretorno' type='text'  title='Local de Embarque para retorno da viagem' value="{{ $contratoviagem[0]->localembarqueretorno }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="" for='dataretorno'>Data do retorno da Viagem</label>
                    <x-adminlte-input class="form-control" name='dataretorno' type='date'  title='Data do retorno da Viagem' value="{{ $contratoviagem[0]->dataretorno }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="" for='horaretorno'>Horário do retorno da viagem</label>
                    <x-adminlte-input class="form-control" name='horaretorno' type='time'  title='Horário do retorno da viagem' value="{{ $contratoviagem[0]->horaretorno }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-rowss">

                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>

        </fieldset>

    </form>

</div>

@stop