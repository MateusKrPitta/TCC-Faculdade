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
    <form class="needs-validation" name='FormularioComprarPassagem' id='FormularioEditarPassagem' action="/passagem/comprar2" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Passagem' name='blocoform01' id='blocoform01'><legend>Informações do Passagem</legend>

            <input type="hidden" name="acao" id="acao" value="Passagemcomprar" />
            <input type="hidden" name="id" id="id" value='{{ $id }}' />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="0" />
            <input type="hidden" name="usuario_id" value="0" />

            <div class="form-row">
                <div class="col-md-4 mb-8">
                    <label class="" for='cliente_id'>Passageiro</label>
                    <x-adminlte-select2 readonly class="form-control" name="cliente_id" title='Escolha o cliente'>
                        @forelse($clientes as $cliente)
                        <option value="{{$cliente->id}}" {{ $id == $cliente->id ? 'selected' : '' }}>{{$cliente->nome}}</option>
                        @empty
                        <option value="">Cadastre um Cliente</option>
                        @endforelse
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>


            <div class="form-row">
                <div class="col-md-4 mb-8">
                    <label class="" for='viagem_id'>Viagem</label>
                    <x-adminlte-select2 class="form-control" name="viagem_id" title='Escolha a Viagem'>
                        @forelse($viagens as $viagem)
                        <option value="{{$viagem->id}}" >{{$viagem->nome}} - {{ date("d/m/Y", strtotime($viagem->data)) }} - {{$viagem->hora}}</option>
                        @empty 
                        <option value="">Cadastre uma Viagem</option>
                        @endforelse
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            
            <br />
            <div class="form-row">

                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Próximo</button>
                </div>
            </div>

        </fieldset>
    </form>

</div>

@stop