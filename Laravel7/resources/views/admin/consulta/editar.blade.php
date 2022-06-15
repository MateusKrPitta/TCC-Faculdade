@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Alterado com Sucesso {{ old('nome_paciente') }}</div>
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

<div class=" col-sm-12">
    <!--Formulario-->
    <form class="needs-validation" name='FormularioEditarConsulta' id='FormularioEditarProcedimento' action="/consulta/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Procedimento' name='blocoform01' id='blocoform01'><legend>Informações da Consulta</legend>

            <input type="hidden" name="acao" id="acao" value="Consultaeditar" />
            <input type="hidden" name="id" id="id" value='{{ $consultas[0]->id }}' />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="2" />
            <input type="hidden" name="usuario_id" value="2" />

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='cliente_id'>Paciente</label>
                    <x-adminlte-select2 name="cliente_id" class="form-control">
                        @forelse($clientes as $cliente)
                        <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                        @empty
                        <option value="">Cadastre um Paciente</option>
                        @endforelse
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-4 mb-4">
                    <label class="" for='data'>Data da Consulta</label>
                    <x-adminlte-input class="form-control" name='data' type='date' title='Informe a data da Consulta' value="{{ $consultas[0]->data }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='horario_consulta'>Horário da Cosulta</label>
                    <x-adminlte-input class="form-control" name='horario_consulta' type='time'  title='Informe o Horário da Consulta' value="{{ $consultas[0]->horario_consulta }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='medico_id'>Medico</label>
                    <x-adminlte-select2 name="medico_id" class="form-control">
                        @forelse($medicos as $medico)
                        <option value="{{$medico->id}}">{{$medico->nome}}</option>
                        @empty
                        <option value="">Cadastre um Médico</option>
                        @endforelse
                        </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>
                
                <div  class="col-sm-1">
                    <label class="control-label col-sm-1" for='status'>Status</label>
                    <x-adminlte-select2 class="form-control" name="status" title='Escolha o status do Usuário' >
                        <option value="1"{{ $consultas[0]->status == "1" ? ' selected' : '' }}>Ativo</option> 
                        <option value="0"{{ $consultas [0]->status == "0" ? ' selected' : '' }}>Inativo</option> 
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