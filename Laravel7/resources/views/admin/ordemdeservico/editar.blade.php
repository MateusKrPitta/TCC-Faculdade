@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('nome') }}</div>
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
    <form class="needs-validation" name='FormularioEditarOrdemdeservico' id='FormularioEditarOrdemdeServico' action="/cliente/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Orçamentos' name='blocoform01' id='blocoform01'><legend>Editar Ordem de Serviço</legend>

            <input type="hidden" name="acao" id="acao" value="Ordemdeservico" />
            <input type="hidden" name="id" id="id" value='{{ $ordemdeservico[0]->id }}' />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="0" />
            <input type="hidden" name="usuario_id" value="0" />

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='cliente_id'>Cliente</label>
                        <x-adminlte-select2 name="cliente_id" id="cliente_id" class="form-control">
                            @forelse($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                            @empty
                            @endforelse
                        </x-adminlte-select2>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="" for='orcamento_id'>Orçamento</label>
                        <x-adminlte-select2 name="orcamento_id" id="orcamento_id" class="form-control">
                            @forelse($orcamentos as $orcamento)
                            <option value="{{ $orcamento->id }}">{{ $orcamento->nome }}</option>
                            @empty
                            @endforelse
                        </x-adminlte-select2>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="" for='valor'>Valor</label>
                    <x-adminlte-input class="form-control" name='valor' type='text' size='10'  title='Informe o valor' value="{{ $errors->all() ? old('valor') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>

        </fieldset>

    </form>

</div>

@stop