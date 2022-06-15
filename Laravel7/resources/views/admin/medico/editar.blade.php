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
    <form class="needs-validation" name='FormularioEditarMedico' id='FormularioEditarMedico' action="/medico/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Medico' name='blocoform01' id='blocoform01'><legend>Informações do Medico</legend>

            <input type="hidden" name="acao" id="acao" value="Medicoeditar" />
            <input type="hidden" name="id" id="id" value='{{ $medicos[0]->id }}' />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="2" />
            <input type="hidden" name="usuario_id" value="2" />

            <div class="form-row">

                <div class="col-md-3 mb-3">
                    <label class="" for='nome'>Nome</label>
                    <x-adminlte-input class="form-control" name='nome' type='text'  title='Informe o Nome' value="{{ $medicos[0]->nome }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="control-label col-lg-5" for='especialidade_id'>Especialidade</label>
                    <x-adminlte-select2 name="especialidade_id" id="especialidade_id" class="form-control">
                        @forelse($especialidades as $especialidade)
                        <option value="{{ $especialidade->id }}">{{ $especialidade->nome }}</option>
                        @empty
                        @endforelse
                    </x-adminlte-select2>
                </div>

            </div>
            <div class="form-row">
                <div class="col-md-2 mb-2">
                    <label class="" for='numeroconselhoregional'>CRM</label>
                    <x-adminlte-input class="form-control" name='numeroconselhoregional' type='text'  title='Informe o número do CRM' value="{{ $medicos[0]->numeroconselhoregional }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>


            </div>
            <div class="form-row">
                <div  class="col-md-15 mb-5">
                    <label class="" for='status'>Status</label>
                    <x-adminlte-select2 class="form-control" name="status" title='Escolha o status do Usuário' >
                        <option value="1"{{ $medicos[0]->status == "1" ? ' selected' : '' }}>Ativo</option> 
                        <option value="0"{{ $medicos[0]->status == "0" ? ' selected' : '' }}>Inativo</option> 
                    </x-adminlte-select2>
                </div>
            </div>



            <div class="form-row">
                <div  class="col-md-6 mb-6">
                    <div class="control-label col-sm-4" >
                        <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                    </div>
                </div>
            </div>

        </fieldset>

    </form>

</div>

@stop