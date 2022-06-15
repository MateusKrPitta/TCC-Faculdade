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
    <form class="needs-validation" name='FormularioEditarPassagem' id='FormularioEditarPassagem' action="/passagem/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Passagem' name='blocoform01' id='blocoform01'><legend>Informações do Passagem</legend>

            <input type="hidden" name="acao" id="acao" value="Passagemeditar" />
            <input type="hidden" name="id" id="id" value='{{ $passagem[0]->id }}' />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="0" />
            <input type="hidden" name="usuario_id" value="0" />

            <div class="form-row">
                <div class="col-md-4 mb-8">
                    <label class="" for='cliente_id'>Cliente</label>
                    <x-adminlte-select2 class="form-control" name="cliente_id" title='Escolha o cliente'>
                        @forelse($clientes as $cliente)
                        <option value="{{$cliente->id}}" {{ $passagem[0]->cliente_id == $cliente->id ? 'selected' : '' }}>{{$cliente->nome}}</option>
                        @empty
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
                        <option value="{{$viagem->id}}" {{ $passagem[0]->viagem_id == $viagem->id ? 'selected' : '' }} >{{$viagem->nome}} - {{$viagem->data}} - {{$viagem->hora}}</option>
                        @empty 
                        @endforelse
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3 mb-4">
                    <label class="" for='acento'>Poltrona</label>
                    <x-adminlte-select2 class="form-control" name="acento" title='Escolha o acento'>
                        <option value="" >Escolha uma poltrona</option>
                        @forelse($acentos as $acento)
                        <option value="{{$acento['acento']}}" class="{{$acento['cor']}}" {{ $acento['acento'] == $passagem[0]->acento ? 'selected' : '' }} >{{$acento['nome']}}</option>
                        @empty
                        @endforelse
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-2 mb-2">
                    <label class=""  for='localembarque'>Local de embarque</label>
                    <x-adminlte-input class="form-control" name='localembarque' type='text' size='' title='Coloque a cidade de embarque da viagem' value="{{$passagem[0]->localembarque}}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">

                <div class="col-md-2 mb-2">
                    <label class=""  for='valor'>Valor</label>
                    <x-adminlte-input class="form-control" name='valor' type='text' size='10' title='Coloque o valor da viagem' value="{{ number_format($passagem[0]->valor,2,',','.') }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>


                <div class="col-md-2 mb-4">
                    <label class="control-label col-sm-1" for='pagamento'>Pagamento</label>
                    <x-adminlte-select2 class="form-control" name="pagamento" title='Forma de pagamento' >
                        <option value="1" {{ $passagem[0]->pagamento == "1" ? 'selected' : '' }} >Pago</option> 
                        <option value="2" {{ $passagem[0]->pagamento == "2" ? 'selected' : '' }} >Contas a Receber</option> 
                    </x-adminlte-select2>
                </div><!-- comment -->

            </div>

            <input type="hidden" name="status" id="status" value="1" >

            <br />
            <div class="form-row">

                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>

        </fieldset>
    </form>

</div>

@stop