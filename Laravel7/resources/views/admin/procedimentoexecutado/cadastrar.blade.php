@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('procedimento_id'))
@if(!$errors->all())
<div class="alert alert-success"> Cadastrado</div>
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
    <form class="needs-validation" name='FormularioCadastrarProcedimentoexecutado' id='FormularioCadastrarProcedimentoexecutado' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Procedimento Executado' name='blocoform01' id='blocoform01'><legend>Informações do Procedimento Executado</legend>

            <input type="hidden" name="acao" id="acao" value="Procedimentoexecutadonovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="0" />
            <input type="hidden" name="usuario_id" value="0" />

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='procedimento_id'>Procedimento</label>
                    <x-adminlte-select2 class="form-control" name="procedimento_id" id="procedimento_id" class="procedimento_id">
                        @forelse($procedimentos as $procedimento)
                        <option value="{{ $procedimento->id }}">{{ $procedimento->nome }}</option>
                        @empty
                        <option value="">Cadastre uma Consulta</option>
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
                    <x-adminlte-input class="form-control" name='data_da_execucao' type='date'  title='Informe a Data do Procedimento' value="{{ $errors->all() ? old('data') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-2 mb-1">
                    <label class="" for='valor'>Valor do Procedimento</label>
                    <x-adminlte-input class="form-control" name='valor' type='numer'  title='Informe o Valor do Procedimento' value="{{ $errors->all() ? old('valor') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>                
                </div>  

            </div>
            </div>

            <input type="hidden" name="status" id="status" value="1" />

            <div class="form-row">

                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>

        </fieldset>
    </form>
</div>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@stop