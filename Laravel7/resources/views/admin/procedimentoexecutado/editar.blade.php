@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('tipo_procedimento') }}</div>
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
    <form class="needs-validation" name='FormularioEditarProcedimentoexecutado' id='FormularioEditarProcedimentoexecutado' action="/procedimentoexecutado/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Procedimento' name='blocoform01' id='blocoform01'><legend>Informações do Procedimento Executado</legend>

            <input type="hidden" name="acao" id="acao" value="Procedimentoexecutadoeditar" />
            <input type="hidden" name="id" id="id" value='{{ $procedimentoexecutado[0]->id }}' />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="2" />
            <input type="hidden" name="usuario_id" value="2" />

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='procedimento_id'>Procedimento</label>
                    <x-adminlte-select2 class="form-control" name="procedimento_id" id="procedimento_id" class="procedimento_id">
                        @forelse($procedimentos as $procedimento)
                        <option value="{{ $procedimento->id }}">{{ $procedimento->nome }}</option>
                        @empty
                        <option value="">Cadastre um Procedimento</option>
                        @endforelse
                    </x-adminlte-select2>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3 mb-3">                   
                    <label class="" for='medico_id'>Medico</label>
                    <x-adminlte-select2 class="form-control" name="medico_id" id="medico_id" class="medico_id">
                        @forelse($medicos as $medico)
                        <option value="{{ $medico->id }}">{{ $medico->nome }}</option>
                        @empty
                        <option value="">Cadastre uma Medico</option>
                        @endforelse
                    </x-adminlte-select2>
                </div>
                <div class="col-md-3 mb-3">                     
                    <label class="" for='cliente_id'>Paciente</label>
                    <x-adminlte-select2  class="form-control" name="cliente_id" id="cliente_id" class="cliente_id">
                        @forelse($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                        @empty
                        <option value="">Cadastre uma Paciente</option>
                        @endforelse
                    </x-adminlte-select2>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='data_da_execucao'>Data do Procedimento</label>
                    <x-adminlte-input class="form-control" name='data_da_execucao' type='date'  title='Informe a Data do Procedimento' value="{{ $procedimentoexecutado[0]->data_da_execucao }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-2 mb-1">
                    <label class="" for='valor'>Valor do Procedimento</label>
                    <x-adminlte-input class="form-control" name='valor' type='numer'  title='Informe o Valor do Procedimento' value="{{ number_format($procedimentoexecutado[0]->valor,2,',','.') }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div  class="col-sm-1">
                    <label class="control-label col-sm-1" for='status'>Status</label>
                    <x-adminlte-select2 class="form-control" name="status" title='Escolha o status do Usuário' >
                        <option value="1"{{ $procedimentoexecutado [0]->status == "1" ? ' selected' : '' }}>Ativo</option> 
                        <option value="0"{{ $procedimentoexecutado [0]->status == "0" ? ' selected' : '' }}>Inativo</option> 
                    </x-adminlte-select2>
                </div>
            </div>



            <div class="form-row">

                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>

        </fieldset>

    </form>

</div>

@stop