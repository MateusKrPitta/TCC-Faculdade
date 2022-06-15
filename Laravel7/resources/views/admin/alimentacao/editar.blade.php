@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('peso'))
@if(!$errors->all())
<div class="alert alert-success"> Alimentação Cadastrado </div>
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

<div class=" col-lg-12">
    <!--Formulario-->
    <form class="needs-validation" name='FormularioEditarAlimentacao' id='FormularioEditarAlimentacao' action="/alimentacao/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações da Alimento' name='blocoform01' id='blocoform01'></fieldset>
            <legend>Informações da Alimentação</legend>

            <input type="hidden" name="id" id="id" value="{{$alimentacao->id}}" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />

            <div class="form-row">
                <div class="col-md-3 mb-2">
                    <label class="" for='animal_id'>Animal</label>
                    <x-adminlte-select2 name="animal_id" id="animal_id" class="form-control">
                        @forelse($animals as $animal)
                        <option value="{{ $animal->id }}" {{ $animal->id == $alimentacao->animal_id ? ' selected' : '' }} > {{ $animal->nome }}</option>
                        @empty
                        <option value="">Nenhum animal cadastrado</option>
                        @endforelse
                        </x-adminlte-select2>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3 mb-2">
                    <label class="" for='alimento_id'>Alimento</label>              
                    <x-adminlte-select2 name="alimento_id" id="alimento_id" class="form-control">
                        @forelse($alimentos as $alimento)
                        <option value="{{ $alimento->id }}" {{ $alimento->id == $alimentacao->alimento_id ? ' selected' : '' }} > {{ $alimento->nome }} </option>
                        @empty
                        <option value="">Nenhum alimento cadastrado</option>
                        @endforelse
                    </x-adminlte-select2>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3 mb-2">
                    <label class="" for='peso'>Peso</label>               
                    <x-adminlte-input class='form-control' name='peso' id='peso' type='numer' size='10' title='Informe o peso' value="{{ $alimentacao->peso }}"/>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3 mb-2">
                    <label class="" for='dataalimentacao'>Data Alimentação</label>              
                    <x-adminlte-input class='form-control' name='dataalimentacao' id='datafim' type='date' size='10' title='Informe a data de alimentação' value="{{ $alimentacao->dataalimentacao }}"/>
                </div>
            </div>
            <br />
            <div class="form-row col-sm-10">
                <div class="control-label col-lg-5" >

                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>

        </div>
    </form>
</div>

@stop