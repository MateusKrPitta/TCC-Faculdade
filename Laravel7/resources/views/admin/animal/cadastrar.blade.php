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
    <form class="needs-validation" name='FormularioCadastrarAnimal' id='FormularioCadastrarAnimal' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações do Animal' name='blocoform01' id='blocoform01'><legend>Informações do Animal</legend>

                <input type="hidden" name="acao" id="acao" value="Animalnovogravar" />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
                <input type="hidden" name="status" id="status" value="1" />
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label class="" for='nome'>Nome</label>
                        <x-adminlte-input class="form-control" name='nome' type='text' size='50' title='Coloque o nome do Animal' value="{{ $errors->all() ? old('nome') : '' }}"/>
                    </div>

                    <div class="col-md-2 mb-2">
                        <label class="" for='numero'>Número</label>
                        <x-adminlte-input class="form-control" name='numero' type='number' size='50' title='Coloque o número do brinco Animal' value="{{ $errors->all() ? old('numero') : '' }}"/>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="" for='nascimento'>Nascimento</label>
                        <x-adminlte-input class="form-control" name='nascimento' type='date' size='50' title='Informe a data do nascimento do Animal' value="{{ $errors->all() ? old('nascimento') : '' }}"/>
                    </div>

                    <div class="col-md-1 mb-1">
                        <label class="" for='peso'>Peso KG</label>
                        <x-adminlte-input class="form-control" name='peso' type='text' size='50' title='Informe o peso do animal em quilos' value="{{ $errors->all() ? old('peso') : '' }}"/>
                    </div>
                </div>
                <div class="form-row">

                    <div class="col-md-3 mb-3">
                        <label class="" for='pai'>Pai</label>
                        <x-adminlte-input class="form-control" name='pai' type='text' size='50' title='Informe o nome do pai no animal' value="{{ $errors->all() ? old('pai') : '' }}"/>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="" for='mae'>Mãe</label>
                        <x-adminlte-input class="form-control" name='mae' type='text' size='50' title='Informe o nome da mãe do animal' value="{{ $errors->all() ? old('cpfcnpj') : '' }}"/>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="" for='sexo'>Sexo</label>
                        <x-adminlte-select2 name="sexo" class="form-control">
                            <option value='M' {{ $errors->all() & (old('sexo') == "M") ? ' selected' : '' }} >Masculino</option>
                            <option value='F' {{ $errors->all() & (old('sexo') == "F") ? ' selected' : '' }} >Feminino</option> 
                        </x-adminlte-select2>
                    </div>
                </div>

                <div class="form-row">
                    <div class="control-label" ></div>
                    <div class="control-label" >
                        <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                    </div>
                </div>

            </fieldset>
        </div>
    </form>
</div>

@stop