@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('diasdegestacao'))
@if(!$errors->all())
<div class="alert alert-success">  Atualizado !!! </div>
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
    <form class="needs-validation" name='FormularioEditarConfiguracao' id='FormularioEditarConfiguracao' action="/configuracao/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações do Configuracao' name='blocoform01' id='blocoform01'><legend>Informações do Configuracao</legend>

                <input type="hidden" name="acao" id="acao" value="Configuracaoeditar" />
                <input type="hidden" name="id" id="id" value='{{ $configuracao->id }}' />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label class="" for='diasdegestacao'>Dias de gestação</label>                   
                        <x-adminlte-input class="form-control col-sm-4" name='diasdegestacao' type='text' size='10' title='Coloque o dias da gestação' value="{{ $configuracao->diasdegestacao }}"/>
                    </div>

                    <div class="col-md-5 mb-3">
                        <label class="" for='mesesparaprimeirainseminacao'>Quantidade de meses para a primeira inseminação</label>
                        <x-adminlte-input class="form-control col-sm-3" name='mesesparaprimeirainseminacao' type='text' size='10' title='Informe o mês da primera inseminação' value="{{ $configuracao->mesesparaprimeirainseminacao }}"/>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="" for='pesominimoparainseminacao'>Peso mínimo para a primeira inseminação</label>                   
                        <x-adminlte-input class="form-control col-sm-4" name='pesominimoparainseminacao' type='text' size='10' title='Coloque o número do brinco Configuracao' value="{{ $configuracao->pesominimoparainseminacao }}"/>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="" for='diasparainseminacao'>Quantidade de dias para inseminação após o parto</label>                   
                        <x-adminlte-input class="form-control col-sm-4" name='diasparainseminacao' type='text' size='10' title='Coloque o número do brinco Configuracao' value="{{ $configuracao->diasparainseminacao }}"/>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="" for='diasparaconfirmacaodeinseminacao'>Quantidade de dias para confirmação da inseminação</label>                    
                        <x-adminlte-input class="form-control col-sm-4" name='diasparaconfirmacaodeinseminacao' type='text' size='10' title='Coloque o nome do Configuracao' value="{{ $configuracao->diasparaconfirmacaodeinseminacao }}"/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="" for='diasparasecaravacaantesdoparto'>Quantidade de dias para secar a vaca antes do parto</label>                   
                        <x-adminlte-input class="form-control col-sm-4" name='diasparasecaravacaantesdoparto' type='text' size='10' title='Coloque o número do brinco Configuracao' value="{{ $configuracao->diasparasecaravacaantesdoparto }}"/>
                    </div>
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