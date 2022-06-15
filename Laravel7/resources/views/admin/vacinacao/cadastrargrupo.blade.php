@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('datavacina'))
@if(!$errors->all())
<div class="alert alert-success"> Vacinados dia: {{ implode('/', array_reverse(explode('-', old('datavacina') ))) }} </div>
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
    <form class="needs-validation" name='FormularioCadastrarVacina' id='FormularioCadastrarVacinacao' action="gravargrupo" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações da Vacina' name='blocoform01' id='blocoform01'></fieldset>
            <legend>Informações da Vacina</legend>

            <input type="hidden" name="acao" id="acao" value="Vacinanovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="status" id="status" value="1" />
            <input type="hidden" name="usuario_id" id="usuario_id" value="{{$usuario_id}}" />

            <div class="form-row">              
                <div class="col-md-2 mb-4">
                    <label class="" for='vacina_id'>Vacina</label>
                    <x-adminlte-select2 name="vacina_id" id="vacina_id" class="form-control">
                        @forelse($vacinas as $vacina)
                        <option value="{{ $vacina->id }}">{{ $vacina->nomevacina }}</option>
                        @empty
                        <option value="">Cadastre uma vacina</option>
                        @endforelse
                    </x-adminlte-select2>
                </div>              
                <div class="col-md-2 mb-4">
                    <label class="" for='datavacina'>Data da vacina</label>
                    <x-adminlte-input class="form-control" name='datavacina' id='datavacina' type='date' size='10' title='Informe a data de início da aplicação da vacina' value=""/>
                </div>
            </div>
            </div>
            <br/>
            <div class="form-row col-sm-12">
                <div class="control-label " ></div>
                <div class="control-label col-lg-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>

        </div>
    </form>
</div>

@stop