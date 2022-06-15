@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('acento') }} </div>
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
<div class="row">
    <div class=" col-sm-8">
        <!--Formulario-->
        <form class="needs-validation" name='FormularioComprarPassagem' id='FormularioEditarPassagem' action="/passagem/comprargravar" enctype="application/x-www-form-urlencoded" method="post" >

            <fieldset title='Informações do Passagem' name='blocoform01' id='blocoform01'><legend>Informações da Passagem</legend>

                <input type="hidden" name="acao" id="acao" value="Passagemcomprar" />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
                <input type="hidden" name="empresa_id" value="0" />
                <input type="hidden" name="usuario_id" value="0" />

                <div class="form-row">
                    <div class="col-md-12 mb-8">
                        <label class="" for='cliente_id'>Passageiro</label>
                        <x-adminlte-select2 readonly class="form-control" name="cliente_id" title='Escolha o cliente'>
                            @forelse($clientes as $cliente)
                            <option value="{{$cliente->id}}" {{ $dados['cliente_id'] == $cliente->id ? 'selected' : '' }}>{{$cliente->nome}}</option>
                            @empty
                            @endforelse
                        </x-adminlte-select2>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-md-12 mb-8">
                        <label class="" for='viagem_id'>Viagem</label>
                        <x-adminlte-select2 readonly class="form-control" name="viagem_id" title='Escolha a Viagem'>
                            @forelse($viagens as $viagem)
                            <option value="{{$viagem->id}}" {{ $dados['viagem_id'] == $viagem->id ? 'selected' : '' }}>{{$viagem->nome}} - {{$viagem->data}} - {{$viagem->hora}}</option>
                            @empty 
                            <option value="">Cadastre uma Viagem</option>
                            @endforelse
                        </x-adminlte-select2>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-5 mb-4">
                        <label class="" for='acento'>Poltrona</label>
                        <x-adminlte-select2 class="form-control" name="acento" title='Escolha o acento'>
                            <option value="" >Escolha uma poltrona</option>
                            @forelse($acentos as $acento)
                            <option value="{{$acento['acento']}}" class="{{$acento['cor']}}">{{$acento['nome']}}</option>
                            @empty 
                            
                            @endforelse
                        </x-adminlte-select2>
                        <div class="valid-feedback">Certo!</div>
                    </div>

                    <div class="col-md-7 mb-2">
                        <label class=""  for='localembarque'>Local de embarque</label>
                        <x-adminlte-input class="form-control" name='localembarque' type='text' size='' title='Coloque a cidade de embarque da viagem' value="Dourados-MS"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3 mb-2">
                        <label class=""  for='valor'>Valor</label>
                        <input class="form-control" name='valor' type='text' size='10' title='Coloque o valor da viagem' value='{{ number_format($viagemselecionada[0]->valor,2,',','.') }}'>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="control-label col-sm-1" for='pagamento'>Pagamento</label>
                        <x-adminlte-select2 class="form-control" name="pagamento" title='Forma de pagamento' >
                            <option value="2" >Pago</option> 
                            <option value="1" >Contas a Receber</option> 
                        </x-adminlte-select2>
                    </div>
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

    <div class=" col-sm-4">
        @include('admin.veiculotransportadora.'.$viagemselecionada[0]->desenho)
    </div>
</div>
@stop