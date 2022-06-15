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
    <form class="needs-validation" name='FormularioEditarProcedimento' id='FormularioEditarProcedimento' action="/procedimento/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Procedimento' name='blocoform01' id='blocoform01'><legend>Informações do Procedimento</legend>

            <input type="hidden" name="acao" id="acao" value="Procedimentoeditar" />
            <input type="hidden" name="id" id="id" value='{{ $procedimentos[0]->id }}' />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="2" />
            <input type="hidden" name="usuario_id" value="2" />

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='nome'>Procedimento</label>
                    <x-adminlte-input class="form-control" name='nome' type='text' size='90' title='Coloque o nome do Procedimento' value="{{ $procedimentos[0]->nome }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="form-row col-sm-6">
                    <div class="col-lg-7">
                        <label class="control-label col-lg-3" for='especialidade_id'>Especialidade</label>
                        <x-adminlte-select2 name="especialidade_id" id="especialidade_id" class="form-control">
                            @forelse($especialidades as $especialidade)
                            <option value="{{ $especialidade->id }}">{{ $especialidade->nome }}</option>
                            @empty
                            <option value="">Cadastre uma Especialidade</option>
                            @endforelse
                        </x-adminlte-select2>
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="col-md-2 mb-2">
                    <label class="" for='tempo'>Tempo do Procedimento</label>
                    <x-adminlte-input class="form-control" name='tempo' type='date' title='Informe o Tempo do Procedimento' value="{{ $procedimentos[0]->tempo }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-1 mb-1">
                    <label class="" for='valor'>Valor</label>
                    <x-adminlte-input class="form-control" name='valor' type='number'  title='Informe o Valor' value="{{ $procedimentos[0]->valor }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div  class="col-sm-2">
                    <label class="control-label col-sm-1" for='status'>Status</label>
                    <x-adminlte-input class="form-control" name="status" title='Escolha o status do Usuário' >
                        <option value="1"{{ $procedimentos[0]->status == "1" ? ' selected' : '' }}>Ativo</option> 
                        <option value="0"{{ $procedimentos [0]->status == "0" ? ' selected' : '' }}>Inativo</option> 
                    </x-adminlte-input>
                </div>
            </div>

            <div class="form-row">

                
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