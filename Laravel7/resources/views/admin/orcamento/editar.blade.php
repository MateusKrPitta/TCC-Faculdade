@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado</div>
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
    <form class="needs-validation" name='FormularioCadastrarOrcamento' id='FormularioCadastrarOrcamento' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Orçamento' name='blocoform01' id='blocoform01'><legend>Informações do Orçamento</legend>

            <input type="hidden" name="acao" id="acao" value="Orcamentonovogravar" />
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
                    <label class="" for='data'>Data do Orçamento</label>
                    <x-adminlte-input class="form-control" name='data' type='date' title='Informe data do atendimento' value="{{ $errors->all() ? old('data') : date('Y-m-d') }}"/>

                    <div class="valid-feedback">Certo!</div>
                </div>

            </div>

            <input type="hidden" name="status" id="status" value="1" />

            <div class="form-row">
                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>

        </fieldset>
    </form>
</div>
@stop

