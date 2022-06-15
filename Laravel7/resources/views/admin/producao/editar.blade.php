@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('animal_id'))
@if(!$errors->all())
<div class="alert alert-success"> Código do Animal: {{ old('animal_id') }} - Data: {{ old('data_producao') }} - Quantidade de Leite: {{ old('quantidade') }}</div>
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
    <form class="needs-validation" name='FormularioCadastrarProducao' id='FormularioCadastrarProducao' action="/producao/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações da Produção' name='blocoform01' id='blocoform01'><legend>Informações da Produção</legend>


                <input type="hidden" name="id" id="id" value='{{ $producao->id }}' />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />




                <div class="form-row">
                    <div class="col-md-3 mb-4">
                        <label class="" for='animal_id'>Animal</label>
                        <x-adminlte-select2 name="animal_id" id="animal_id"class="form-control">
                            @forelse($listadeanimais as $animal)
                            <option value="{{ $animal->animal_id }}"{{ $animal->animal_id == $producao->animal_id ? ' selected' : '' }} >{{ $animal->animal_nome }} </option>
                            @empty
                            <option value="">Nenhum animal cadastrado</option>
                            @endforelse
                        </x-adminlte-select2>
                    </div>
                    <div class="col-md-2 mb-4">
                        <label class="" for='data_producao'>Data da Produção</label>
                        <x-adminlte-input class="form-control" name='data_producao' type='date' size='50' title='Informe a data da Producao' value="{{ $producao->data_producao }}"/>
                    </div>
                    <div class="col-md-2 mb-4">
                        <label class="" for='hora_producao'>Turno</label>
                        <x-adminlte-select2 name="hora_producao" class="form-control">
                            <option value="07:00:00"{{ $errors->all() & (old('hora_producao') == "07:00:00") ? ' selected' : '' }}>Manhã</option>
                            <option value="15:00:00"{{ $errors->all() & (old('hora_producao') == "15:00:00") ? ' selected' : '' }}>Tarde</option>
                        </x-adminlte-select2>
                    </div>

                    <div class="col-md-2 mb-4">
                        <label class="" for='quantidade'>Quantidade</label>
                        <input class="form-control" name='quantidade' type='text' size='50' title='Coloque a quantidade de leite produzido' value="{{ $producao->quantidade }}"/>
                    </div>
                </div>
        </div>

        <div class="form-row">
            <div class="control-label col-sm-5" ></div>
            <div class="control-label col-sm-4" >
                <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
            </div>
        </div>

        </fieldset>
</div>
</form>
</div>


@stop