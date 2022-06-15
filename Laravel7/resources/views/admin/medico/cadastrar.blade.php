@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado Doutor(a): {{ old('nome') }}</div>
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
    <form class="needs-validation" name='FormularioCadastrarMedico' id='FormularioCadastrarMedico' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Medico' name='blocoform01' id='blocoform01'><legend>Informações do Médico</legend>

            <input type="hidden" name="acao" id="acao" value="Mediconovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="0" />
            <input type="hidden" name="usuario_id" value="0" />
            
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
                <div class="col-md-5 mb-6">
                    <label class="" for='nome'>Nome</label>
                    <x-adminlte-input class="form-control" name='nome' type='text'  title='Informe o Nome' value="{{ $errors->all() ? old('nome') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <br/>
                 <div class="col-md-5 mb-6">
                    <label class="" for='numeroconselhoregional'>Numero do Concelho Regional</label>
                    <x-adminlte-input class="form-control" name='numeroconselhoregional' type='text'  title='Informe o número do Conselho Regional' value="{{ $errors->all() ? old('numeroconselhoregional') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>
            
 
            <input type="hidden" name="status" id="status" value="1" />

            <br/>
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