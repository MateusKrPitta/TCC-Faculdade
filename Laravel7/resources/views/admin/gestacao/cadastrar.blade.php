@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('inseminacao_id'))
@if(!$errors->all())
<div class="alert alert-success"> Examinador: {{ old('examinador') }}</div>
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
    <form class="needs-validation" name='FormularioCadastrarGestacao' id='FormularioCadastrarGestacao' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >
        <fieldset title='Informações da Gestação' name='blocoform01' id='blocoform01'><legend>Informações da Gestação</legend>
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <div class="form-row">
                <div class="col-md-2 mb-4">
                    <label class="" for='inseminacao_id'>Animal</label>                    
                    <x-adminlte-select2 name="inseminacao_id" class="form-control">
                        @forelse($listadeanimais as $animal)
                        <option value="{{ $animal->id }}">{{ $animal->nome }}</option>
                        @empty 
                        <option value="">Cadastre um Animal</option>
                        @endforelse
                    </x-adminlte-select2>                       
                </div>
                <div class="col-md-2 mb-4">
                    <label class="" for='dataconfirmacao'>Data da Confirmação</label>
                    <x-adminlte-input class="form-control" name='dataconfirmacao' type='date' size='50' title='Informe a Data do Nascimento do Gestacao' value="{{ $errors->all() ? old('dataconfirmacao') : '' }}"/>
                </div>
                <div class="col-md-2 mb-4">
                    <label class="" for='examinador'>Nome do Examinador</label>
                    <x-adminlte-input class="form-control" name='examinador' type='text' size='50' title='Coloque o nome do Inseminador' value="{{ $errors->all() ? old('examinador') : '' }}"/>
                </div>
                <div class="col-md-2 mb-4">
                    <label class="" for='status_gestacao'>Fecundação</label>
                    <x-adminlte-select2 name="status_gestacao" class="form-control">
                        <option value="1"{{ $errors->all() & (old('status_gestacao') == "1") ? ' selected' : '' }}>Fecundou</option>
                        <option value="2"{{ $errors->all() & (old('status_gestacao') == "2") ? ' selected' : '' }}>Não Fecundou</option>
                    </x-adminlte-select2>
                </div>
            </div>
            <div class="form-row">
                <div class="control-label col-sm-4" ></div>
                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>

        </fieldset>

    </form>
</div>


@stop