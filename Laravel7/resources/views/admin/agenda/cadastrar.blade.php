@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('nome') }} - {{ old('data') }}</div>
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
    <form class="needs-validation" name='FormularioCadastrarAgenda' id='FormularioCadastrarAgenda' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Agenda' name='blocoform01' id='blocoform01'><legend>Informações do Agenda</legend>

            <input type="hidden" name="acao" id="acao" value="Agendanovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="2" />
            <input type="hidden" name="usuario_id" value="2" />

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label class="" for='nome'>Nome</label>
                    <x-adminlte-input class="form-control" name='nome' type='text' size='90' title='Coloque o nome do Contato da Agenda' value="{{ $errors->all() ? old('nome') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-4 mb-4">
                    <label class="" for='evento'>Evento</label>
                    <x-adminlte-input class="form-control" name='evento' type='text' title='Informe o nome do Evento' value="{{ $errors->all() ? old('evento') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-2 mb-2">
                    <label class="" for='data'>Data</label>
                    <x-adminlte-input class="form-control" name='data' type='date'  title='Informe a Data' value="{{ $errors->all() ? old('data') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>


                <div class="col-md-2 mb-2">
                    <label class="" for='hora'>Hora</label>
                    <x-adminlte-input class="form-control" name='hora' type='time' title='Informe a hora do Evento' value="{{ $errors->all() ? old('hora') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">

                <div class="col-md-6 mb-6">
                    <label class="" for='observacao'>Observações</label>
                    <x-adminlte-textarea class="form-control" name='observacao' type='text' title='Informe dados importantes aqui' value="{{ $errors->all() ? old('observacao') : '' }}"></x-adminlte-textarea>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>



            <input type="hidden" name="status" id="status" value="1" />

            <br />
            <div class="form-row">

                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>

        </fieldset>
</div>
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