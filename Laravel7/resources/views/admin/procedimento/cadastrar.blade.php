@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: - {{ old('nome') }}</div>
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
    <form class="needs-validation" name='FormularioCadastrarProcedimento' id='FormularioCadastrarProcedimento' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Procedimento' name='blocoform01' id='blocoform01'><legend>Informações do Procedimento</legend>

            <input type="hidden" name="acao" id="acao" value="Procedimentonovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="0" />
            <input type="hidden" name="usuario_id" value="0" />

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='nome'>Procedimento</label>
                    <x-adminlte-input class="form-control" name='nome' type='text'  title='Informe o Procedimento' value="{{ $errors->all() ? old('nome') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="form-row col-sm-4">
                    <div class="col-lg-7">
                        <label class="control-label col-lg-3" for='especialidade_id'>Especialidade</label>
                        <x-adminlte-select2 name="especialidade_id" id="especialidade_id" class="form-control">
                            @forelse($especialidades as $especialidade)
                            <option value='{{$especialidade->id}}' {{ $errors->all() & (old('especialidade_id') == "especialidade_id") ? ' selected' : '' }} >{{$especialidade->nome}}</option>
                            @empty
                            <option value="">Cadastre uma Especialidade</option>
                            @endforelse
                        </x-adminlte-select2>
                    </div>

                </div>
            </div>
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='tempo'>Tempo do Processamento</label>
                    <x-adminlte-input class="form-control" name='tempo' type='numeric'  title='Informe o Tempo do Processo' value="{{ $errors->all() ? old('tempo') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-2 mb-1">
                    <label class="" for='valor'>Valor do Procedimento</label>
                    <x-adminlte-input class="form-control" name='valor' type='number'  title='Informe o Valor do Procedimento' value="{{ $errors->all() ? old('valor') : '' }}"/>
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