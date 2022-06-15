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
                <input type="hidden" name="id" id="id" value='{{ $vacina[0]->id }}' />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />

                <div class="form-row ">
                <div class="col-md-4 mb-4">
                    <label class="" for='nomevacina'>Nome</label>
                    <x-adminlte-input class="form-control" name='nomevacina' id='nomevacina' type='text' size='50' title='Coloque o nome do Vacina' value="{{ $vacina[0]->nomevacina }}"/>
                </div>                              
                <div class="col-md-2 mb-4">
                    <label class="" for='sexoaplicacao'>Sexo para aplicação</label>
                    <x-adminlte-select2 name="sexoaplicacao" id="sexoaplicacao" class="form-control" title='Selecione o sexo de destino desta Vacina'>
                        <option value="A"{{ $errors->all() & (old('sexoaplicacao') == "A") ? ' selected' : '' }}>Ambos</option>
                        <option value="F"{{ $errors->all() & (old('sexoaplicacao') == "F") ? ' selected' : '' }}>Fêmea</option>
                        <option value="M"{{ $errors->all() & (old('sexoaplicacao') == "M") ? ' selected' : '' }}>Macho</option>
                    </x-adminlte-select2>
                </div>
                <div class="col-md-2 mb-4">
                    <label class="" for='datainicio'>Data Início</label>
                    <x-adminlte-input class="form-control" name='datainicio' id='datainicio' type='date' size='10' title='Informe a data de início da aplicação da vacina' value="{{ $vacina[0]->datainicio }}"/>
                </div>

                <div class="col-md-2 mb-4">
                    <label class="" for='datafim'>Data Fim</label>
                    <x-adminlte-input class="form-control" name='datafim' id='datafim' type='date' size='10' title='Informe a data do fim da aplicação da vacina' value="{{ $vacina[0]->datafim }}"/>
                </div>

            </div>
            <div class="form-row">                
                <div class="col-md-3 mb-4">
                    <label class="" for='tipovacina'>Tipo de Vacina</label>
                    <x-adminlte-select2 name="tipovacina" id="tipovacina" class="form-control">
                        <option value="A" {{ $errors->all() & (old('tipovacina') == "A") ? ' selected' : '' }}>Aleatória</option>
                        <option value="U" {{ $errors->all() & (old('tipovacina') == "U") ? ' selected' : '' }}>Única</option>
                        <option value="P" {{ $errors->all() & (old('tipovacina') == "P") ? ' selected' : '' }}>Periódica</option>
                    </x-adminlte-select2>
                </div>
                <div class="col-md-3 mb-4">
                    <label class="" for='intervalovacina'>Intervalo (Meses)</label>
                    <x-adminlte-input class="form-control" name='intervalovacina' id='intervalovacina' type='number' size='50' title='Tempo até a próxima Vacina' value="{{ $vacina[0]->intervalovacina }}"  /> (Informar quando a opção do tipo de vacina marcado por periódica)
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