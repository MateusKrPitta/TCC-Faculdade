@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('quantidade'))
@if(!$errors->all())
<div class="alert alert-success"> Registro gravado para o dia: {{ date( 'd/m/Y' , strtotime(old('data_producao'))) }} </div>
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
    <form class="needs-validation" name='FormularioCadastrarProducao' id='FormularioCadastrarProducao' action="gravargrupo" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações da Produção' name='blocoform01' id='blocoform01'><legend>Informações da Produção</legend>

                <input type="hidden" name="acao" id="acao" value="Producaonovogravar" />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />

                <input type="hidden" name="usuario_id" id="usuario_id" value="{{$usuario_id}}" />

                <div class="form-row">                   
                    <div class="col-md-2 mb-4">
                        <label class="" for='data_producao'>Data da Produção</label>
                        <x-adminlte-input class="form-control" name='data_producao' type='date' size='50' title='Informe a data da Producao' value=""/>
                    </div>
                    <div class="col-md-2 mb-4">
                        <label class="" for='hora_producao'>Turno</label>
                        <x-adminlte-select2 name="hora_producao" class="form-control">
                            <option value="07:00:00">Manhã</option>
                            <option value="15:00:00">Tarde</option>
                        </x-adminlte-select2>
                    </div>
                    <div class="form-row">                   
                        <div class="col-md-4 mb-4">
                            <label class="" for='quantidade'>Quantidade</label>
                            <x-adminlte-input class="form-control" name='quantidade' type='text' size='50' title='Coloque a quantidade de leite produzido' value=""/>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="control-label col-sm-2" ></div>
                    <div class="control-label col-sm-4" >
                        <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                    </div>
                </div>

            </fieldset>
        </div>
    </form>
</div>


@stop