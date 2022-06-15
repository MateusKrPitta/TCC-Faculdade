@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('localdedestino'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('localdedestino') }} - {{ old('valor') }}</div>
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
    <form class="needs-validation" name='FormularioCadastrarContratoviagem' id='FormularioCadastrarContratoviagem' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >
        <fieldset title='Informações do Contrato' name='blocoform01' id='blocoform01'><legend>Informações do Contrato de Viagem</legend>
            <input type="hidden" name="acao" id="acao" value="Contratoviagemnovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="2" />
            <input type="hidden" name="usuario_id" value="2" />
            <div class="form-row">
                <div class="col-md-4 mb-4">
                    <label class="" for='cliente_id'>Cliente</label>
                    <x-adminlte-select2 class="form-control" name="cliente_id" title='Escolha a Viagem'>
                        @forelse($clientes as $cliente)
                        <option value="{{$cliente->id}}" > {{$cliente->nome}} </option>
                        @empty
                        @endforelse
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-4 mb-4">
                    <label class="" for='veiculo_id'>Veículo</label>
                    <x-adminlte-select2 class="form-control" name="veiculo_id" title='Escolha a Viagem'>
                        @forelse($veiculos as $veiculo)
                        <option value="{{$veiculo->id}}" > {{$veiculo->nome}} </option>
                        @empty
                        @endforelse
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-2">
                    <label class="" for='datadocontrato'>Data do contrato</label>
                    <x-adminlte-input class="form-control" name='datadocontrato' type='date'  title='Data do contrato' value="{{ $errors->all() ? old('datacontrato') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-4 mb-4">
                    <label class="" for='localdedestino'>Local de Destino</label>
                    <x-adminlte-input class="form-control" name='localdedestino' type='text'  title='Local de destino da viagem' value="{{ $errors->all() ? old('localdedestino') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-6 mb-6">
                    <label class="" for='itinerario'>Itinerário</label>
                    <x-adminlte-input class="form-control" name='itinerario' type='text' size='90' title='Coloque o itinerário da viagem' value="{{ $errors->all() ? old('itinerario') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='valor'>Valor</label>
                    <x-adminlte-input class="form-control" name='valor' type='text' title='Valor do contrato' value="{{ $errors->all() ? old('valor') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-4 mb-4">
                    <label class="" for='localembarqueinicio'>Local de Embarque para início da viagem</label>
                    <x-adminlte-input class="form-control" name='localembarqueinicio' type='text'  title='Local de Embarque para início da viagem' value="{{ $errors->all() ? old('localembarqueinicio') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="" for='datainicio'>Data do início da Viagem</label>
                    <x-adminlte-input class="form-control" name='datainicio' type='date'  title='Data do início da Viagem' value="{{ $errors->all() ? old('datainicio') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="" for='horainicio'>Horário do início da viagem</label>
                    <x-adminlte-input class="form-control" name='horainicio' type='time'  title='Horário do início da viagem' value="{{ $errors->all() ? old('horainicio') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-4 mb-4">
                    <label class="" for='localembarqueretorno'>Local de Embarque para retorno da viagem</label>
                    <x-adminlte-input class="form-control" name='localembarqueretorno' type='text'  title='Local de Embarque para retorno da viagem' value="{{ $errors->all() ? old('localembarqueretorno') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="" for='dataretorno'>Data do retorno da Viagem</label>
                    <x-adminlte-input class="form-control" name='dataretorno' type='date'  title='Data do retorno da Viagem' value="{{ $errors->all() ? old('dataretorno') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="" for='horaretorno'>Horário do retorno da viagem</label>
                    <x-adminlte-input class="form-control" name='horaretorno' type='time'  title='Horário do retorno da viagem' value="{{ $errors->all() ? old('horaretorno') : '' }}"/>
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