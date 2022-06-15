@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('cliente_id'))
@if(!$errors->all())
<div class="alert alert-success"> Cadastrado com Sucesso !!! </div>
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
    <form class="needs-validation" name='FormularioCadastrarExameexecutado' id='FormularioCadastrarExameexecutado' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Exame' name='blocoform01' id='blocoform01'><legend>Informações do Exame Executado</legend>

            <input type="hidden" name="acao" id="acao" value="Exameexecutadonovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="0" />
            <input type="hidden" name="usuario_id" value="0" />

            <div class="form-row">
                <div class="col-md-3 mb-2">
                    <label class="" for='cliente_id'>Paciente</label>
                    <x-adminlte-select2 class="form-control" name="cliente_id" id="cliente_id" class="cliente_id">
                        @forelse($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                        @empty
                        <option value="">Cadastre um Paciente</option>
                        @endforelse
                    </x-adminlte-select2>
                </div>
            </div>

            <div class="form-row">             
                <div class="col-md-4 mb-2">                     
                    <label class="" for='exame_id'>Exame</label>
                    <x-adminlte-select2  class="form-control" name="exame_id" id="exame_id" class="exame_id">
                        @forelse($exames as $exame)
                        <option value="{{ $exame->id }}">{{ $exame->nome }}</option>
                        @empty
                        <option value="">Cadastre uma Exame</option>
                        @endforelse
                    </x-adminlte-select2>
                </div>
                <div class="col-md-3 mb-3">        
                    <label class="" for='resultado'>Resultado</label>
                    <x-adminlte-input class="form-control" name='resultado' type='text' title='Informe o resultado' value="{{ $errors->all() ? old('resultado') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-2 mb-2"> 
                    <label class="" for='hora'>Horário</label>
                    <x-adminlte-input class="form-control" name='hora' type='time' title='Informe o Horário' value="{{ $errors->all() ? old('horário') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>


                <div class="col-md-2 mb-2">        
                    <label class="" for='data'>Data</label>
                    <x-adminlte-input class="form-control" name='data' type='date' title='Informe a Data' value="{{ $errors->all() ? old('data') : '' }}"/>
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