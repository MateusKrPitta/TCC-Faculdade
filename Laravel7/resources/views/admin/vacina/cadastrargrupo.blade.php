@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('id_usuario'))
@if(!$errors->all())
<div class="alert alert-success"> Usuário: {{ old('id_usuario') }} </div>
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
    <form class="needs-validation" name='FormularioCadastrarVacina' id='FormularioCadastrarVacina' action="gravargrupo" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações da Vacina' name='blocoform01' id='blocoform01'><legend>Informações da Vacina</legend>

                <input type="hidden" name="acao" id="acao" value="Vacinanovogravar" />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />

                <input type="hidden" name="id_usuario" id="id_usuario" value="{{$id_usuario}}" />

                <div class="form-row">
                    <div class="col-sm-3">
                        <label class="control-label col-sm-2" for='data_vacina'>Data da Vacina</label>
                         <x-adminlte-input class="form-control col-sm-4" name='data_vacina' type='date' size='50' title='Informe a data da Vacina' value="" />
                    </div>



                    <div class="col-sm-3">
                        <label class="control-label col-sm-2" for='hora_vacina'>Turno</label>
                        <x-adminlte-select2 name="hora_vacina" class="form-control col-sm-4">
                            <option value="07:00:00">Manhã</option>
                            <option value="15:00:00">Tarde</option>
                        <x-adminlte-select2>
                    </div>

                </div>

                <div class="form-row">
                    <div class="col-sm-3">
                        <label class="control-label col-sm-2" for='quantidade'>Quantidade</label>
                         <x-adminlte-input class="form-control col-sm-4" name='quantidade' type='text' size='50' title='Coloque a quantidade de leite produzido' value="" />
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