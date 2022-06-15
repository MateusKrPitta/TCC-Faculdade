@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('nome') }} - {{ old('cpfcnpj') }}</div>
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
    <form class="needs-validation" name='FormularioCadastrarTelemarketingtransporte' id='FormularioCadastrarTelemarketingtransporte' action="/telemarketingtransporte/gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Telemarketingtransporte' name='blocoform01' id='blocoform01'>
            <legend>Informações da conversa</legend>

            <input type="hidden" name="acao" id="acao" value="Telemarketingtransportenovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="0" />
            <input type="hidden" name="usuario_id" value="0" />
            
            <input type="hidden" name="cliente_id" id="cliente_id" value="{{ $cliente->id }}" />
            
            <label>Nome: </label>
            {{ $cliente->nome }}
            <br />
            <label>Telefone 1: </label>
            {{ $cliente->tel1 }}
            <br />
            <label>Telefone 2: </label>
            {{ $cliente->tel2 }}
            <br />
            <div class="form-row">
                <div class="col-md-12 mb-12">
                    <label class="" for='descricao'>Descrição da Conversa</label>
                    <x-adminlte-input class="form-control" name='descricao' type='text' title='Descreva o conteúdo da conversa.' value="" />
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <input type="hidden" name="status" id="status" value="1" />
            <br />
            <div class="form-row">
                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' name='botaogravar' value="gravar" title='Aperte este botão para gravar os dados.'>Gravar - Finalizar Ligação</button>
                </div>
                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-info btn-block" type='submit' id='botaogravar' name='botaogravar' value="vender" title='Aperte este botão para gravar os dados.'>Vender Passagem</button>
                </div>
                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-danger btn-block" type='submit' id='botaogravar' name='botaogravar' value="bloquear" title='Aperte este botão para gravar os dados.'>Bloquear - Não Ligar Futuramente</button>
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