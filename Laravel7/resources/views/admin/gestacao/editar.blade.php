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
    <form class="needs-validation" name='FormularioEditarAnimal' id='FormularioEditarAnimal' action="/animal/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações do Animal' name='blocoform01' id='blocoform01'><legend>Informações do Animal</legend>

                <input type="hidden" name="acao" id="acao" value="Animaleditar" />
                <input type="hidden" name="id" id="id" value='{{ $animal[0]->id }}' />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />

                <div class="form-row">
                    <div class="col-sm-3">
                        <label class="control-label col-sm-2" for='nome'>Nome</label>
                        <x-adminlte-input class="form-control col-sm-4" name='nome' type='text' size='50' title='Coloque o nome do Animal' value="{{ $animal[0]->nome }}"/>
                    </div>

                    <div class="col-sm-3">
                        <label class="control-label col-sm-2" for='numero'>Número</label>
                        <x-adminlte-input class="form-control col-sm-4" name='numero' type='text' size='50' title='Coloque o número do brinco Animal' value="{{ $animal[0]->numero }}"/>
                    </div>
                </div>
                
                <div class="form-row">                  
                    <div class="col-sm-3">
                        <label class="control-label col-sm-2" for='nascimento'>Nascimento</label>
                        <x-adminlte-input class="form-control col-sm-4" name='nascimento' type='date' size='50' title='Informe a data do nascimento do Animal' value="{{ $animal[0]->nascimento }}"/>
                    </div>
                    
                    
                    <div class="col-sm-3">
                        <label class="control-label col-sm-2" for='peso'>Peso KG</label>
                        <x-adminlte-input class="form-control col-sm-4" name='peso' type='text' size='50' title='Informe o peso do animal em quilos' value="{{ $animal[0]->peso }}"/>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-sm-3">
                        <label class="control-label col-sm-2" for='pai'>Pai</label>                   
                        <x-adminlte-input class="form-control col-sm-4" name='pai' type='text' size='50' title='Informe o nome do pai no animal' value="{{ $animal[0]->pai }}"/>
                    </div>

                    
                    <div class="col-sm-3">
                        <label class="control-label col-sm-2" for='mae'>Mãe</label>
                        <x-adminlte-input class="form-control col-sm-4" name='mae' type='text' size='50' title='Informe o nome da mãe do animal' value="{{ $animal[0]->mae }}"/>
                    </div>

                    <input type="hidden" name="status" id="status" value="{{ $animal[0]->status }}" />

                </div>


                <div class="form-row">
                    <label class="control-label col-sm-2" for='sexo'>Sexo</label>
                    <div class="col-sm-3">
                        <x-adminlte-select2 name="sexo" class="form-control col-sm-4">
                            <option value='M' {{ $animal[0]->sexo == "M" ? ' selected' : '' }} >Masculino</option>
                            <option value='F' {{ $animal[0]->sexo == "F" ? ' selected' : '' }} >Feminino</option> 
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
        </div>
    </form>

</div>

@stop