@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nomevacina'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('nomevacina') }} </div>
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
    <form class="needs-validation" name='FormularioCadastrarVacina' id='form-horizontalFormularioCadastrarVacina' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações da Vacina' name='blocoform01' id='blocoform01'></fieldset>
            <legend>Informações da Vacina</legend>

            <input type="hidden" name="acao" id="acao" value="Vacinanovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="status" id="status" value="1" />
            <input type="hidden" name="usuario_id" id="usuario_id" value="{{$usuario_id}}" />

            <div class="form-row ">
                <div class="col-md-4 mb-4">
                    <label class="" for='nomevacina'>Nome</label>
                    <x-adminlte-input class="form-control" name='nomevacina' id='nomevacina' type='text' size='50' title='Coloque o nome do Vacina' value="{{ $errors->all() ? old('nomevacina') : '' }}" />
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
                    <x-adminlte-input class="form-control" name='datainicio' id='datainicio' type='date' size='10' title='Informe a data de início da aplicação da vacina' value="{{ $errors->all() ? old('datainicio') : '' }}"/>
                </div>

                <div class="col-md-2 mb-4">
                    <label class="" for='datafim'>Data Fim</label>
                    <x-adminlte-input class="form-control" name='datafim' id='datafim' type='date' size='10' title='Informe a data do fim da aplicação da vacina' value="{{ $errors->all() ? old('datafim') : '' }}"/>
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
                    <x-adminlte-input class="form-control" name='intervalovacina' id='intervalovacina' type='number' size='50' title='Tempo até a próxima Vacina' value="{{ $errors->all() ? old('intervalovacina') : '' }}"/> (Informar quando a opção do tipo de vacina marcado por periódica)
                </div>
            </div> 
            <div class="form-row">
                <div class="col-md-4 mb-4">
                        <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                    </div>
                </div>

            </div>
        </div>
</div>
</div>



</form>
</div>

@stop