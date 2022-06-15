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
    <form class="needs-validation" name='FormularioEditarServico' id='FormularioEditarServico' action="/servico/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações do Servico' name='blocoform01' id='blocoform01'><legend>Informações do Serviço</legend>

                <input type="hidden" name="acao" id="acao" value="Servicoeditar" />
                <input type="hidden" name="id" id="id" value='{{ $servico[0]->id }}' />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />


                <div class="form-row">
                    <div class="col-sm-3">
                        <label class="control-label col-sm-2" for='nome'>Nome</label>
                        <x-adminlte-input class="form-control" name='nome' type='text' size='90' title='Coloque o nome do Servico ' value="{{ $servico[0]->nome }}"/>
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label col-sm-5" for='tempo'>Tempo</label>
                        <x-adminlte-input class="form-control" name='tempo' type='number' size='999999999999999' title='Informe o tempo de serviço' value="{{ $servico[0]->tempo  }}"/>
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label col-sm-6" for='valor'>Valor</label>
                        <x-adminlte-input class="form-control" name='valor' type='number' size='999999999999999' title='Coloque o valor' value="{{ $servico[0]->valor }}"/>
                    </div>
                </div>
                <div class="form-row">


                    <div class="col-sm-8">
                        <label class="control-label col-sm-2" for='observacoes'>Observações</label>
                        <x-adminlte-textarea class="form-control col-sm-12" name='observacoes' type='text' size='50' rows="5" cols="33"  title='Coloque detalhes adicionais'>{{ $servico[0]->observacao }}</x-adminlte-textarea>
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