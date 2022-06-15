@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success">Exame de {{ old('nome') }} Cadastrado !!! </div>
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
    <form class="needs-validation" name='FormularioCadastrarExame' id='FormularioCadastrarExame' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Exame' name='blocoform01' id='blocoform01'><legend>Informações do Exame</legend>

            <input type="hidden" name="acao" id="acao" value="Examenovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="0" />
            <input type="hidden" name="usuario_id" value="0" />

            <div class="form-row">
                <div class="col-md-4 mb-4">
                    <label class="" for='nome'>Nome</label>
                    <x-adminlte-input class="form-control" name='nome' type='text' title='Coloque o nome do Exame' value="{{ $errors->all() ? old('nome') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-2 mb-4">
                    <label class="" for='valor'>Valor</label>
                    <x-adminlte-input class="form-control" name='valor' type='numer' title='Informe o Valor' value="{{ $errors->all() ? old('valor') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="form-row">
                    <div class="col-md-5 mb-3">
                        <label class="" for='valor_referencia'>Valor Referência</label>
                        <x-adminlte-input class="form-control" name='valor_referencia' type='text'  title='Informe a Referência' value="{{ $errors->all() ? old('valor_referencial') : '' }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="" for='tempo'>Tempo</label>
                        <x-adminlte-input class="form-control" name='tempo' type='text' title='Informe o Tempo do Exame em horas' value="{{ $errors->all() ? old('tempo') : '' }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                </div>

            </div>           
            <div class="form-row">
                <div class="col-md-12 mb-4">
                    <label class="" for='descricao'>Descrição</label>
                    <x-adminlte-textarea rows="5" class="form-control" name='descricao' type='text' title='Coloque o nome do Exame' value="{{ $errors->all() ? old('descricao') : '' }}" ></x-adminlte-textarea>
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