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
    <form class="needs-validation" name='FormularioEditarViagem' id='FormularioEditarViagem' action="/viagem/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Viagem' name='blocoform01' id='blocoform01'><legend>Informações do Viagem</legend>

            <input type="hidden" name="acao" id="acao" value="Viagemeditar" />
            <input type="hidden" name="id" id="id" value='{{ $viagem[0]->id }}' />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="2" />
            <input type="hidden" name="usuario_id" value="2" />

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label class="" for='nome'>Nome</label>
                    <x-adminlte-input class="form-control" name='nome' type='text' size='90' title='Coloque o nome da Viagem' value="{{ $viagem[0]->nome }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='origem'>Origem</label>
                    <x-adminlte-input class="form-control" name='origem' type='text' title='Informe a origem' value="{{ $viagem[0]->origem }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='destino'>Destino</label>
                    <x-adminlte-input class="form-control" name='destino' type='text'  title='Informe o destino' value="{{ $viagem[0]->destino }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='veiculo_id'>Veiculo</label>
                    <x-adminlte-select2 name="veiculo_id" class="form-control">
                        @forelse($veiculos as $veiculo)
                        <option value="{{$veiculo->id}}" {{ $viagem[0]->veiculo_id == $veiculo->id ? ' selected' : '' }}>{{$veiculo->nome}}</option>
                        @empty
                        <option value="" >Cadastre um Veículo</option>
                        @endforelse
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div><!-- comment -->

                <div class="col-md-2 mb-2">
                    <label class=""  for='valor'>Valor</label>
                    <x-adminlte-input class="form-control" name='valor' type='text' size='10' title='Coloque o valor da viagem' value="{{ number_format($viagem[0]->valor,2,',','.') }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div><!-- comment -->

                <div class="col-md-2 mb-2">
                    <label class="" for='data'>Data</label>
                    <x-adminlte-input class="form-control" name='data' type='date'  title='Informe a data' value="{{ $viagem[0]->data }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='hora'>Hora</label>
                    <x-adminlte-input class="form-control" name='hora' type='time' size='10' title='Informe a Hora' value="{{ $viagem[0]->hora }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

            </div>

            <div class="form-row">
                <div class="col-md-6 mb-6">
                    <label class="" for='observacao'>Observações</label>
                    <x-adminlte-textarea class="form-control" name='observacao' type='text' title='Informe o número do Telefone'>{{ $viagem[0]->observacao }}</x-adminlte-textarea>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>
            <div class="form-row">

                <div class="col-md-2 mb-1">
                    <label class="control-label col-sm-1" for='status'>Status</label>
                    <x-adminlte-select2 class="form-control" name="status" title='Escolha o status' >
                        <option value="1" {{ $viagem[0]->status == "1" ? 'selected' : '' }}>Ativo</option> 
                        <option value="0" {{ $viagem[0]->status == "0" ? 'selected' : '' }}>Inativo</option> 
                    </x-adminlte-select2>
                </div>
            </div>
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