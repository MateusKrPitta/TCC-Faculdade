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
    <form class="needs-validation" name='FormularioEditarConfiguracao' id='FormularioEditarConfiguracao' action="atualizarconfig" enctype="application/x-www-form-urlencoded" method="post" >
        <div>
            <fieldset title='Informações do Configuracao' name='blocoform01' id='blocoform01'><legend>Informações do Configuracao</legend>
                <input type="hidden" name="acao" id="acao" value="Configuracaoeditar" />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
                <div class="form-row">
                    <div class="col-md-12 mb-2">
                        <label class="" for='titulocontrato1'>Título no contrato primeira linha</label>                   
                        <x-adminlte-input class="form-control " name='titulocontrato1' type='text' title='Título no contrato primeira linha' value="{{ $configuracao->titulocontrato1 }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-2">
                        <label class="" for='titulocontrato2'>Título no contrato segunda linha</label>
                        <x-adminlte-input class="form-control " name='titulocontrato2' type='text' title='Título no contrato segunda linha' value="{{ $configuracao->titulocontrato2 }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-2">
                        <label class="" for='endereco1'>Endereço primeira linha</label>                   
                        <x-adminlte-input class="form-control " name='endereco1' type='text' title='Endereço primeira linha' value="{{ $configuracao->endereco1 }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-2">
                        <label class="" for='endereco2'>Endereço segunda linha</label>                   
                        <x-adminlte-input class="form-control " name='endereco2' type='text' title='Endereço segunda linha' value="{{ $configuracao->endereco2 }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-2">
                        <label class="" for='razaosocial'>Razão Social no Contrato</label>                   
                        <x-adminlte-input class="form-control " name='razaosocial' type='text' title='Razão Social no Contrato' value="{{ $configuracao->razaosocial }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-2">
                        <label class="" for='enderecorazaosocial'>Endereço da Razão Social</label>                   
                        <x-adminlte-input class="form-control " name='enderecorazaosocial' type='text' title='Endereço da Razão Social' value="{{ $configuracao->enderecorazaosocial }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-2">
                        <label class="" for='cnpj'>CNPJ no contrato</label>                   
                        <x-adminlte-input class="form-control " name='cnpj' type='text' title='CNPJ no contrato' value="{{ $configuracao->cnpj }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-2">
                        <label class="" for='inscricaomunicipal'>Inscrição Municipal no contrato</label>                   
                        <x-adminlte-input class="form-control " name='inscricaomunicipal' type='text' title='Inscrição Municipal no contrato' value="{{ $configuracao->inscricaomunicipal }}"/>
                    </div>
                </div>
                <div>
                    <div class="form-row">
                        <div class="col-md-12 mb-2">
                            <label class="" for='valorintegral'>Valor Anual Integral</label>                   
                            <x-adminlte-input class="form-control " name='valorintegral' type='text' title='Valor Anual Integral' value="{{ $configuracao->valorintegral }}"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-2">
                            <label class="" for='valorparcial'>Valor Anual Parcial</label>                   
                            <x-adminlte-input class="form-control " name='valorparcial' type='text' title='Valor Anual Parcial' value="{{ $configuracao->valorparcial }}"/>
                        </div>
                    </div><div class="form-row">
                        <div class="col-md-12 mb-2">
                            <label class="" for='valorhoraextra'>Valor Hora Extra</label>                   
                            <x-adminlte-input class="form-control " name='valorhoraextra' type='text' title='Valor Hora Extra' value="{{ $configuracao->valorhoraextra }}"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-2">
                            <label class="" for='valorrefeicaoextra'>Valor Refeição Extra</label>                   
                            <x-adminlte-input class="form-control " name='valorrefeicaoextra' type='text' title='Valor Refeição Extra' value="{{ $configuracao->valorrefeicaoextra }}"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-2">
                            <label class="" for='valor19horas'>Valor após as 19:00</label>                   
                            <x-adminlte-input class="form-control " name='valor19horas' type='text' title='Valor após as 19:00' value="{{ $configuracao->valor19horas }}"/>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-2">
                        <label class="" for='horariointegral'>Horário de Funcionamento Integral</label>                   
                        <x-adminlte-input class="form-control " name='horariointegral' type='text' title='Horário de Funcionamento Integral' value="{{ $configuracao->horariointegral }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-2">
                        <label class="" for='horarioparcial'>Horário de Funcionamento Parcial</label>                   
                        <x-adminlte-input class="form-control " name='horarioparcial' type='text' title='Horário de Funcionamento Parcial' value="{{ $configuracao->horarioparcial }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-2">
                        <label class="" for='anexotexto'>Texto no Anexo</label>                   
                        <x-adminlte-textarea  class="form-control " name='anexotexto' type='text' title='Texto no Anexo' rows=5 >{{ $configuracao->anexotexto }}</x-adminlte-textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12 mb-2">
                        <label class="" for='cidadeforo'>Comarca da cidade eleita como Foro</label>                   
                        <x-adminlte-input class="form-control " name='cidadeforo' type='text' title='Comarca da cidade eleita como Foro' value="{{ $configuracao->cidadeforo }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-2">
                        <label class="" for='cidadecontrato'>Cidade de assinatura do contrato</label>                   
                        <x-adminlte-input class="form-control " name='cidadecontrato' type='text' title='Cidade local da assinatura do contrato' value="{{ $configuracao->cidadecontrato }}"/>
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