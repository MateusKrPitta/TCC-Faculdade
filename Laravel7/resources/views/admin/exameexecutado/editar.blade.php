@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('hora'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('hora') }}</div>
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
    <form class="needs-validation" name='FormularioEditarExameexecutado' id='FormularioEditarExameexecutado' action="/exameexecutado/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Procedimento' name='blocoform01' id='blocoform01'><legend>Informações do Exame Executado</legend>

            <input type="hidden" name="acao" id="acao" value="Exameexecutadoeditar" />
            <input type="hidden" name="id" id="id" value='{{ $exameexecutados[0]->id }}' />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="2" />
            <input type="hidden" name="usuario_id" value="2" />

            <div class="form-row">
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
                    <label class="" for='exame_id'>Exame</label>
                    <x-adminlte-select2 class="form-control" name="exame_id" id="exame_id" class="exame_id">
                        @forelse($exames as $exame)
                        <option value="{{ $exame->id }}">{{ $exame->nome }}</option>
                        @empty
                        <option value="">Cadastre uma Exame</option>
                        @endforelse
                    </x-adminlte-select2>
                </div>
                
                <div class="col-md-3 mb-3">        
                    <label class="" for='resultado'>Resultado</label>
                    <x-adminlte-input class="form-control" name='resultado' type='text' title='Informe o resultado' value="{{ $exameexecutados[0]->resultado }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>
             <div class="form-row">
                <div class="col-md-2 mb-2"> 
                    <label class="" for='hora'>Horário</label>
                    <x-adminlte-input class="form-control" name='hora' type='time' title='Informe o Horário' value="{{ $exameexecutados[0]->hora }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>


                <div class="col-md-2 mb-2">        
                    <label class="" for='data'>Data</label>
                    <x-adminlte-input class="form-control" name='data' type='date' title='Informe a Data' value="{{ $exameexecutados[0]->data }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            
                <div  class="col-sm-1">
                    <label class="control-label col-sm-1" for='status'>Status</label>
                    <x-adminlte-select2 class="form-control" name="status" title='Escolha o status do Usuário' >
                        <option value="1"{{ $exameexecutados [0]->status == "1" ? ' selected' : '' }}>Ativo</option> 
                        <option value="0"{{ $exameexecutados  [0]->status == "0" ? ' selected' : '' }}>Inativo</option> 
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