@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('nome') }} </div>
@endif
@if($errors->all())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $mensagemerro)
        <li>{{$mensagemerro}}</li>
        @endforeach
        <li>Os dados não foram gravados</li>
    </ul>
</div>
@endif
@endif

<div class=" col-lg-12 box box-solid box-footer">{{-- MELHOR Combinação para ajuste na tela --}}
    <!--Formulario-->
    <form class="form-horizontal" name='FormularioCadastrarDiario' id='FormularioCadastrarDiario' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações do Diario' name='blocoform01' id='blocoform01'><legend>Informações do Diario</legend>

                <input type="hidden" name="acao" id="acao" value="Diarionovogravar" />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
                <input type="hidden" name="status" id="status" value="1" />
                <input type="hidden" name="id_usuario" id="id_usuario" value="{{$id_usuario}}" />

                <div class="form-group">
                    <label class="control-label col-sm-2" for='nome'>Nome</label>
                    <div class="col-sm-3">
                        <x-adminlte-input class="form-control col-sm-4" name='nome' type='text' size='50' title='Coloque o nome do Diario' value="" />
                    </div>
                    <label class="control-label col-sm-1" for='ano'>Ano</label>
                    <div class="col-sm-2">
                        <x-adminlte-select2 name="ano" class="form-control col-sm-4">	
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            </x-adminlte-select2>
                    </div>
                    <label class="control-label col-sm-1" for='periodo'>Período</label>
                    <div class="col-sm-2">
                        <x-adminlte-select2 name="periodo" class="form-control col-sm-4">
                            <option value="M">Matutino</option>
                            <option value="V">Vespertino</option>
                            <option value="E">Extendido</option>
                            <option value="I">Integral</option>
                        </x-adminlte-select2>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for='observacoes'>Observações</label>
                    <div class="col-sm-8">
                        <x-adminlte-textarea class="form-control col-sm-12" name='observacoes' type='text' size='50' rows="5" cols="33"  title='Coloque detalhes adicionais' value="" ></x-adminlte-textarea>
                    </div>
                </div>
            </fieldset>


            <br />
            <div class="form-group">
                <div class="control-label col-sm-4" ></div>
                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>


        </div>
    </form>
</div>


@stop