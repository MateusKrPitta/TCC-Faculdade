@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('nome') }} - {{ old('valor') }}</div>
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
    <form class="needs-validation" name='FormularioCadastrarPassagem' id='FormularioCadastrarPassagem' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Passagem' name='blocoform01' id='blocoform01'><legend>Informações da Passagem</legend>

            <input type="hidden" name="acao" id="acao" value="Passagemnovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="0" />
            <input type="hidden" name="usuario_id" value="0" />


            <div class="form-row">
                <div class="col-md-4 mb-8">
                    <label class="" for='cliente_id'>Cliente</label>
                    <x-adminlte-select2 class="form-control" name="cliente_id" title='Escolha o cliente'>
                        @forelse($clientes as $cliente)
                        <option value="{{$cliente->id}}" >{{$cliente->nome}}</option>
                        @empty
                        <option value="">Cadastre um Cliente</option>
                        @endforelse
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>


            <div class="form-row">
                <div class="col-md-4 mb-8">
                    <label class="" for='viagem_id'>Viagem</label>
                    <x-adminlte-select2 class="form-control" name="viagem_id" title='Escolha a Viagem'>
                        @forelse($viagens as $viagem)
                        <option value="{{$viagem->id}}" >{{$viagem->nome}} - {{$viagem->data}} - {{$viagem->hora}}</option>
                        @empty 
                        <option value="">Cadastre uma viagem</option>
                        @endforelse
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='acento'>Poltrona</label>
                    <x-adminlte-select2 class="form-control" name="acento" title='Escolha o acento'>
                        <option value="" >Selecione a Poltrona</option>
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-2 mb-2">
                    <label class=""  for='valor'>Valor</label>
                    <x-adminlte-input class="form-control" name='valor' type='text' size='10' title='Coloque o valor da viagem' value="{{ $errors->all() ? old('valor') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>


                <div class="col-md-2 mb-4">
                    <label class="control-label col-sm-1" for='pagamento'>Pagamento</label>
                    <x-adminlte-select2 class="form-control" name="pagamento" title='Forma de pagamento' >
                        <option value="1" {{ $errors->all() & (old('pagamento') == "1") ? ' selected' : '' }}>Pago</option> 
                        <option value="2" {{ $errors->all() & (old('pagamento') == "2") ? ' selected' : '' }}>Contas a Receber</option> 
                    </x-adminlte-select2>
                </div><!-- comment -->

            </div>

            <input type="hidden" name="status" id="status" value="1" >

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