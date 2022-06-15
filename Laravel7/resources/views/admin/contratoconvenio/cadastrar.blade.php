@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('nome') }} - {{ old('marcamodelo') }}</div>
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
    <form class="needs-validation" name='FormularioCadastrarContratoconvenio' id='FormularioCadastrarContratoconvenio' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Contrato' name='blocoform01' id='blocoform01'><legend>Informações do Contrato</legend>

            <input type="hidden" name="acao" id="acao" value="Contratoconvenionovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="2" />
            <input type="hidden" name="usuario_id" value="2" />
            <input type="hidden" name="conveniado" value="0" />
            <input type="hidden" name="id" id="id" value='0' />

            <div class="form-row">
                <div class="col-md-4 mb-4">
                    <label class="" for='conveniado_id'>Conveniado</label>
                    <x-adminlte-select2 class="form-control" name="conveniado_id" title='Escolha o Conveniado'>
                        @forelse($conveniados as $conveniado)
                        <option value="{{$conveniado->id}}" > {{$conveniado->nome}} </option>
                        @empty
                        <option value="0">Nenhuma conveniado cadastrado</option> 
                        @endforelse
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-2 mb-2">
                    <label class="" for='datadocontrato'>Data do contrato</label>
                    <x-adminlte-input class="form-control" name='datadocontrato' type='date'  title='Data do contrato' value="{{ $errors->all() ? old('datadocontrato') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-4 mb-4">
                    <label class="" for='plano_id'>Plano</label>
                    <x-adminlte-select2 class="form-control" name="plano_id" title='Escolha o Plano'>
                        @forelse($planos as $plano)
                        <option value="{{$plano->id}}" >R$ {{ number_format($plano->valor,2,',','.') }} - {{$plano->nome }} </option>
                        @empty
                        <option value="0">Nenhum Plano cadastrado</option> 
                        @endforelse
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='formadepagamento_id'>Forma de Pagamento</label>
                    <x-adminlte-select2 class="form-control" name="formadepagamento_id" title='Escolha a forma de pagamento'>
                        @forelse($formadepagamentos as $formadepagamento)
                        <option value="{{$formadepagamento->id}}" >{{$formadepagamento->nome }} </option>
                        @empty
                        <option value="0">Nenhuma forma de pagamento cadastrada</option> 
                        @endforelse
                    </x-adminlte-select2>
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