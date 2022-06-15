@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('cliente_id'))
@if(!$errors->all())
<div class="alert alert-success"> Consulta Marcada !!! </div>
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
    <form class="needs-validation" name='FormularioCadastrarConsulta' id='FormularioCadastrarMedico' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações da Consulta' name='blocoform01' id='blocoform01'><legend>Informações da Consulta</legend>

            <input type="hidden" name="acao" id="acao" value="Consultanovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="0" />
            <input type="hidden" name="usuario_id" value="0" />

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
                    <x-adminlte-input class="form-control" name='data' type='date' title='Informe a data da Consulta' value="{{ $errors->all() ? old('data') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                
                <div class="col-md-3 mb-3">
                    <label class="" for='horario_consulta'>Horário da Cosulta</label>
                    <x-adminlte-input class="form-control" name='horario_consulta' type='time'  title='Informe o Horário da Consulta' value="{{ $errors->all() ? old('horario_consulta') : '' }}"/>
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