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
    <form class="needs-validation" name='FormularioCadastrarOrdemdeServico' id='FormularioCadastrarMedico' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações da Ordem de Servico' name='blocoform01' id='blocoform01'><legend>Informações da Ordem de Serviço</legend>

            <input type="hidden" name="acao" id="acao" value="Mediconovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="0" />
            <input type="hidden" name="usuario_id" value="0" />
            
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='cliente_id'>Cliente</label>
                        <x-adminlte-select2 name="cliente_id" id="cliente_id" class="form-control">
                            @forelse($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                            @empty
                            @endforelse
                        </x-adminlte-select2>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="" for='orcamento_id'>Orçamento</label>
                        <x-adminlte-select2 name="orcamento_id" id="orcamento_id" class="form-control">
                            @forelse($orcamentos as $orcamento)
                            <option value="{{ $orcamento->id }}">{{ $orcamento->id }}</option>
                            @empty
                            @endforelse
                        </x-adminlte-select2>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="" for='valor'>Valor</label>
                    <x-adminlte-input class="form-control" name='valor' type='text' size='10'  title='Informe o valor' value="{{ $errors->all() ? old('valor') : '' }}"/>
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