@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('nome') }} - {{ old('origem') }} - {{ old('destino') }}</div>
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
    <form class="needs-validation" name='FormularioCadastrarViagem' id='FormularioCadastrarViagem' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Viagem' name='blocoform01' id='blocoform01'><legend>Informações da Viagem</legend>

            <input type="hidden" name="acao" id="acao" value="Viagemnovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="2" />
            <input type="hidden" name="usuario_id" value="2" />

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label class="" for='nome'>Nome</label>
                    <x-adminlte-input class="form-control" name='nome' type='text' size='90' title='Coloque o nome da Viagem' value="{{ $errors->all() ? old('nome') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='origem'>Origem</label>
                    <x-adminlte-input class="form-control" name='origem' type='text' title='Informe a origem' value="{{ $errors->all() ? old('origem') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='destino'>Destino</label>
                    <x-adminlte-input class="form-control" name='destino' type='text'  title='Informe o destino' value="{{ $errors->all() ? old('destino') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">

                <div class="col-md-3 mb-3">
                    <label class="" for='veiculo_id'>Veiculo</label>
                    <x-adminlte-select2 name="veiculo_id" class="form-control">
                        @forelse($veiculos as $veiculo)
                        <option value="{{$veiculo->id}}">{{$veiculo->nome}}</option>
                        @empty
                        <option value="">Cadastre um Veículo</option>
                        @endforelse
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-2 mb-2">
                    <label class=""  for='valor'>Valor</label>
                    <x-adminlte-input class="form-control" name='valor' type='text' size='10' title='Coloque o valor da viagem' value="{{ $errors->all() ? old('valor') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-2 mb-2">
                    <label class="" for='data'>Data</label>
                    <x-adminlte-input class="form-control" name='data' type='date'  title='Informe a data' value="{{ $errors->all() ? old('data') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='hora'>Hora</label>
                    <x-adminlte-input class="form-control" name='hora' type='time' size='10' title='Informe a Hora' value="{{ $errors->all() ? old('hora') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-12 mb-6">
                    <label class="" for='observacao'>Observações</label>
                    <x-adminlte-textarea rows="5" class="form-control" name='observacao' type='text' title='Informe o número do Telefone'>{{ $errors->all() ? old('observacao') : '' }}</x-adminlte-textarea>
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