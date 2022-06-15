@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('touro'))
@if(!$errors->all())
<div class="alert alert-success"> Reprodutor: {{ old('touro') }} - Inseminador: {{ old('inseminador') }} - Matriz: {{ old('animal_id') }} </div>
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
    <form class="needs-validation" name='FormularioCadastrarInseminacao' id='FormularioCadastrarInseminacao' action="/inseminacao/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações da Inseminação' name='blocoform01' id='blocoform01'><legend>Informações da Inseminação</legend>

                <input type="hidden" name="id" id="id" value="{{$inseminacao->id}}" />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />

                <div class="form-row">
                    <div class="col-md-4 mb-4">
                        <label class="" for='animal_id'>Animal</label>
                        <x-adminlte-select2 name="animal_id" class="form-control">
                            @forelse($listadeanimais as $animal)
                            <option value="{{ $animal->animal_id }}" {{ ($inseminacao->animal_id == $animal->animal_id ) ? ' selected' : '' }}>{{ $animal->animal_nome }}</option>
                            @empty
                            <option value="">Cadastre um Animal</option>
                            @endforelse
                        </x-adminlte-select2>
                    </div>

                    <input type="hidden" name="status" id="status" value="1" />
                    <div class="col-md-4 mb-4">
                        <label class="" for='datainseminacao'>Data da Inseminação</label>
                        <x-adminlte-input class="form-control" name='datainseminacao' type='date' size='50' title='Informe a data do nascimento do Inseminacao' value="{{ $inseminacao->datainseminacao }}"/>
                    </div>                            
                    <div class="col-md-4 mb-4">
                        <label class="" for='turno'>Turno</label>
                        <x-adminlte-select2 name="turno" class="form-control">
                            <option value="M"{{ $errors->all() & (old('turno') == "M") ? ' selected' : '' }}>Manhã</option>
                            <option value="T"{{ $errors->all() & (old('turno') == "T") ? ' selected' : '' }}>Tarde</option>
                        </x-adminlte-select2>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-4 mb-4">
                        <label class="" for='touro'>Identificação do Touro</label>
                        <x-adminlte-input class="form-control" name='touro' type='text' size='50' title='Coloque o nome do Touro' value="{{ $inseminacao->touro }}"/>
                    </div>

                    <div class="col-md-4 mb-4">
                        <label class="" for='inseminador'>Nome do Inseminador</label>
                        <x-adminlte-input class="form-control" name='inseminador' type='text' size='50' title='Coloque o nome do Inseminador' value="{{ $inseminacao->inseminador }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="control-label col-sm-1" ></div>
                    <div class="control-label col-sm-4" >
                        <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                    </div>
                </div>

            </fieldset>
        </div>
    </form>
</div>


@stop